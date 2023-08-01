<?php

namespace Modules\Admin\Repositories;

use Closure;
use Illuminate\Support\Facades\DB;
use Laka\Core\Support\FileManagementService;
use Modules\Admin\Enums\AttributesGroup;
use Modules\Core\Repositories\CoreRepository;
use Modules\Setting\Entities\Attributes\AttributesModel;

abstract class AdminBaseRepository extends CoreRepository
{
    protected $imageColumnName = '';
    protected $depthColumnName = 'depth';
    protected $attributeRelationClass;

    public function create(array $attributes)
    {
        return $this->upsert($attributes, null, function($result) use($attributes) {
            if (!blank($this->attributeRelationClass)) {
                $this->upsertAttributes($this->attributeRelationClass, $attributes, $result->attributes, $result->id);
            }
        });
    }

    public function update(array $attributes, $id)
    {
        return $this->upsert($attributes, $id, function($result) use($attributes) {
            if (!blank($this->attributeRelationClass)) {
                $this->upsertAttributes($this->attributeRelationClass, $attributes, $result->attributes, $result->id);
            }
        });
    }

    protected function upsert(array $attributes, $id = null, Closure $callback = null)
    {
        return DB::transaction(function () use($attributes, $id, $callback) {
            if (isset($attributes[$this->imageColumnName])) {
                $imageNewName = $this->uploadFile($attributes);
                data_set($attributes, $this->imageColumnName, $imageNewName);
            }
            if (!is_null($id))
                $result = parent::update($attributes, $id);
            else
                $result = parent::create($attributes);

            if (!is_null($callback) && is_callable($callback)) {
                $callback($result);
            }

            return $result;
        });
    }

    protected function uploadFile(&$attributes, $imageOld = null)
    {
        if ($this->service && $this->service instanceof FileManagementService) {
            $dataImageName = '';
            $imageName = $this->imageColumnName;
            if (isset($attributes[$imageName])) {
                $fileData = array_first($this->service->uploadFileImages([$attributes[$imageName]]));
                $dataImageName = $fileData['file_name'];
                data_set($attributes, $imageName, $dataImageName);
                if (!blank($imageOld)) {
                    $this->deleteFile($imageOld);
                }
            }
            return $dataImageName;
        }
        return null;
    }

    protected function uploadFiles($attributes, $imageName, $imageOld = null, $isDone = true)
    {
        if ($this->service && $this->service instanceof FileManagementService) {
            $dataImageName = [];
            if (isset($attributes[$imageName])) {
                $filesData = $this->service->uploadFileImages($attributes[$imageName]);
                unset($attributes[$imageName]);
                foreach($filesData as $file) {
                    array_push($dataImageName, $file['file_name']);
                }
            }
            return $dataImageName;
        }
        return null;
    }

    protected function deleteFile($imageName)
    {
        if ($this->service && $this->service instanceof FileManagementService) {
            if (!is_null($imageName) && !empty($imageName)) {
                $this->service->deleteFileType('images', $imageName);
            }
        }
    }

    public function updateOrCreateForenignCategories($repository, $datas, $foreign_id)
    {
        return $this->updateOrCreateForenignColumn($repository, $datas, $foreign_id, 'category_id');
    }

    public function updateOrCreateForenignPromotions($repository, $datas, $foreign_id)
    {
        return $this->updateOrCreateForenignColumn($repository, $datas, $foreign_id, 'promotion_id');
    }

    private function updateOrCreateForenignColumn($repository, $datas, $foreign_id, $column_name)
    {
        $data = $repository->model->getFillable();
        $attributes = array_combine($data, array_fill(0, count($data), $foreign_id));
        foreach ($datas as $cat_id) {
            data_set($attributes, $column_name, $cat_id);
            $repository->updateOrCreate($attributes, array_except($attributes, [$column_name]));
        }
    }

    public function upsertForenignCategories($model, $listNewData, $listData, $foreign_id)
    {
        return $this->upsertForenignColumn($model, $listNewData, $listData, $foreign_id, 'category_id');
    }

    protected function upsertForenignColumn($model, $listNewData, $listData, $foreign_id, $column_name)
    {
        return $this->upsertForenignData($model, $listNewData, $listData, $foreign_id, $column_name, function($data) use($column_name) {
            return collect($data)->map(function($id) use($column_name) {
                return [$column_name => $id];
            })->all();
        });
    }

    public function upsertAttributes($model, $listNewAttrs, $listAttrs, $foreign_id)
    {
        $listAttribute = AttributesModel::pluck('id', 'key');
        if (is_null(data_get($listNewAttrs, AttributesGroup::GROUP_IMAGE.'.other_images'))) {
            $groupId = $listAttribute->get(AttributesGroup::GROUP_IMAGE);
            $otherId = $listAttribute->get('other_images');
            $listAttrs = $listAttrs->reject(function($item) use($groupId, $otherId) {
                return in_array($item->id, [$groupId, $otherId]);
            });
            array_forget($listNewAttrs, AttributesGroup::GROUP_IMAGE.'.other_images');
        }
        return $this->upsertForenignData($model, array_filter($listNewAttrs), $listAttrs, $foreign_id, 'attribute_id', function($data) use($listAttribute) {
            $newListData = [];
            foreach($data as $groupKey => $items) {
                $parentId = $listAttribute->get($groupKey);
                array_push($newListData, ['attribute_id' => $parentId, 'value' => null]);
                foreach ($items as $key => $value) {
                    $newItem = ['attribute_id' => $listAttribute->get($key), 'value' => null];
                    if (is_object($value) || is_array($value)) {
                        if (str_is($groupKey, AttributesGroup::GROUP_IMAGE)) {
                            $listFiles = $this->service->uploadFileImages(array_wrap($value));
                            $newItem['value'] = json_encode(array_map(function($info) {
                                return pathinfo($info['path'], PATHINFO_BASENAME);
                            }, $listFiles));
                            array_push($newListData, $newItem);
                        } else {
                            $listFiles = $this->service->uploadFiles(array_wrap($value));
                            $newItem['value'] = json_encode(array_map(function($info) {
                                $this->service->unzipFile($info['path']);
                                return pathinfo($info['path'], PATHINFO_BASENAME);
                            }, $listFiles));
                            array_push($newListData, $newItem);
                        }
                    } else {
                        $newItem['value'] = $value;
                        array_push($newListData, $newItem);
                    }
                }
            }
            return $newListData;
        });
    }

    protected function upsertForenignData($model, $listNewData, $listData, $foreign_id, $column_name, Closure $callback = null)
    {
        if (!is_object($model)) $model = resolve($model);
        
        $data = $model->getFillable();
        $attributes = array_combine($data, array_fill(0, count($data), $foreign_id));
        if (!is_null($callback) && is_callable($callback)) {
            $listNewData = call_user_func($callback, $listNewData);
        }
        $updatedFields = array_keys(head($listNewData));
        $primaryFields = array_keys(array_except($attributes, $updatedFields));
        $foreign_column = head($primaryFields);
        array_push($primaryFields, $column_name);
        $listOldData = $listData->map(function($item) use($foreign_id, $listNewData, $column_name, $foreign_column) {
            return [
                $foreign_column => $foreign_id,
                $column_name => $item->getKey(),
                'deleted' => !in_array($item->getKey(), array_column($listNewData, $column_name))
            ];
        });
        $listDeleted = $listOldData->filter(function($item) {
            return $item->deleted;
        });
        if ($listDeleted->isNotEmpty()) {
            $result = $model->where($foreign_column, $foreign_id)
                ->whereIn($column_name, $listDeleted->pluck($column_name)->all())->delete();
        }
        $listOldData = $listOldData->keyBy($column_name);
        $listNewData = collect($listNewData);
        if ($listNewData->isNotEmpty()) {
            $listNewData->transform(function($item) use($listOldData, $attributes, $column_name) {
                $key = data_get($item, $column_name);
                return array_merge($attributes, $item, array_except($listOldData->get($key), 'deleted') ?? []);
            });
            $result = $model->query()->upsert($listNewData->all(), $primaryFields, $updatedFields);
        }
        return $result;
    }
}
