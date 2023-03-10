<?php

namespace Modules\Admin\Repositories;

use Closure;
use Illuminate\Support\Facades\DB;
use Laka\Core\Support\FileManagementService;
use Modules\Admin\Enums\AttributesField;
use Modules\Core\Repositories\CoreRepository;
use Modules\Setting\Entities\AttributeModel;
use ZipArchive;

abstract class AdminBaseRepository extends CoreRepository
{
    protected $imageColumnName = '';
    protected $depthColumnName = 'depth';
    protected $attributeRelationClass;

    public function create(array $attributes)
    {
        return $this->upsert($attributes, null, function($result) use($attributes) {
            if (!blank($this->attributeRelationClass)) {
                $this->upsertAttributes($this->attributeRelationClass, $attributes, $result->id);
            }
        });
    }

    public function update(array $attributes, $id)
    {
        return $this->upsert($attributes, $id, function($result) use($attributes) {
            if (!blank($this->attributeRelationClass)) {
                $this->upsertAttributes($this->attributeRelationClass, $attributes, $result->id);
            }
        });
    }

    protected function upsert(array $attributes, $id = null, Closure $callback = null)
    {
        return DB::transaction(function () use($attributes, $id, $callback) {
            if (isset($attributes[$this->imageColumnName])) {
                $imageName = $attributes[$this->imageColumnName];
                $imageNewName = $this->uploadFile($attributes, $this->imageColumnName, $imageName);
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

    protected function uploadFile($attributes, $imageName, $imageOld = null, $isDone = true)
    {
        if ($this->service && $this->service instanceof FileManagementService) {
            $dataImageName = '';
            if (isset($attributes[$imageName])) {
                $fileData = array_first($this->service->uploadFileImages([$attributes[$imageName]]));
                $dataImageName = $fileData['file_name'];
                unset($attributes[$imageName]);
                if ($isDone) {
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

    public function upsertForenignCategories($repository, $datas, $foreign_id)
    {
        return $this->upsertForenignColumn($repository, $datas, $foreign_id, 'category_id');
    }

    protected function upsertForenignColumn($repository, $datas, $foreign_id, $column_name)
    {
        if (!is_object($repository)) $repository = resolve($repository);
        $data = $repository->model->getFillable();
        $attributes = array_combine($data, array_fill(0, count($data), $foreign_id));
        $newListData = array_map(function($id) use($attributes, $column_name) {
            return data_set($attributes, $column_name, $id);
        }, $datas);
        return $repository->model->query()->upsert($newListData, array_keys($attributes), [$column_name]);
    }

    public function upsertAttributes($model, $attributes, $foreign_id)
    {
        if (!is_object($model)) $model = resolve($model);
        $data = $model->getFillable();
        $attributeData = array_combine($data, array_fill(0, count($data), $foreign_id));
        $attrDatas = array_only($attributes, AttributesField::listConstains());
        $listKey = array_only(AttributesField::$FIELDS_MAP, array_keys($attrDatas));
        $listAttribute = AttributeModel::whereIn('key', $listKey)->pluck('id', 'key');
        $newListData = [];
        foreach($attrDatas as $key => $item) {
            $newValue = $item;
            if (is_object($item)) {
                $info = $this->service->uploadFiles([$item]);
                $this->service->unzipFile($info['path']);
                $newValue = pathinfo($info['path'], PATHINFO_FILENAME);
            }
            array_push($newListData, array_merge($attributeData, [
                'attribute_id' => $listAttribute->get(data_get(AttributesField::$FIELDS_MAP, $key)),
                'value' => $newValue
            ]));
        }
        $lstPrimaryKey = array_keys($attributeData);
        array_forget($lstPrimaryKey, 'value');
        return $model->query()->upsert($newListData, $lstPrimaryKey, ['attribute_id', 'value']);
    }
}
