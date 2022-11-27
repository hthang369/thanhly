<?php

namespace Modules\Admin\Repositories;

use Laka\Core\Repositories\CoreRepository;
use Laka\Core\Support\FileManagementService;

abstract class AdminBaseRepository extends CoreRepository
{
    protected $imageColumnName = '';

    public function create(array $attributes)
    {
        if (isset($attributes[$this->imageColumnName])) {
            $imageNewName = $this->uploadFile($attributes, $this->imageColumnName);
            data_set($attributes, $this->imageColumnName, $imageNewName);
        }
        return parent::create($attributes);
    }

    public function update(array $attributes, $id)
    {
        if (isset($attributes[$this->imageColumnName])) {
            $imageName = $attributes[$this->imageColumnName];
            $imageNewName = $this->uploadFile($attributes, $this->imageColumnName, $imageName);
            data_set($attributes, $this->imageColumnName, $imageNewName);
        }
        return parent::update($attributes, $id);
    }

    public function createNestedTree(array $attributes)
    {
        $model = $this->model->newInstance($attributes);

        if ($this->model->count() == 0 || is_null(data_get($attributes, $this->model->getParentIdName(), null))) {
            $model->saveAsRoot();
        } else {
            $parent_id = $attributes[$this->model->getParentIdName()];

            $parentNode = $this->find($parent_id);

            $parentNode->appendNode($model);
        }

        $this->resetModel();

        return $this->parserResult($model);
    }

    public function updateNestedTree(array $attributes, $id)
    {
        $this->applyScope();

        $model = $this->model->findOrFail($id);

        $model->fill($attributes);

        if (is_null(data_get($attributes, $this->model->getParentIdName(), null))) {
            $model->saveAsRoot();
        } else {
            $parent_id = $attributes[$this->model->getParentIdName()];

            $parentNode = $this->find($parent_id);

            $parentNode->appendNode($model);
        }

        $this->resetModel();

        return $this->parserResult($model);
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

    public function paginateNestedTree($limit = null, $columns = [], $method = "paginateNestedTree")
    {
        $this->applyScope();
        $this->applyCriteria();

        $columns = $this->getColumns($columns);

        $limit = is_null($limit) ? $this->getLimitForPagination() : $limit;
        $results = $this->model->{$method}($limit, $columns);
        $results->appends(request()->except($this->except));
        $this->resetQuery();

        return $this->parserResult($results);
    }

    public function allNestedDataGrid()
    {
        if ($this->presenterGrid) {
            $data = $this->paginateNestedTree();
            return [$this->presenterGrid, $data];
        }
        return [];
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
}
