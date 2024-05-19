<?php

namespace Modules\Api\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Laka\Core\Support\FileManagementService;
use Modules\Api\Entities\NewsModel;

class NewsRepository extends NewsBaseRepository
{
    use NewsCriteria;

    protected $serviceClass = FileManagementService::class;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return NewsModel::class;
    }

    public function show($id, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->firstWhere('post_link', $id, $columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    public function parserResult($result)
    {
        if ($result instanceof Collection || $result instanceof LengthAwarePaginator) {
            $result->each(function ($model) {
                $model->post_image = asset('storage/images/'.$model->post_image);

                return $model;
            });
        }

        return $result;
    }

    public function uploadFile($fileUpload)
    {
        if ($this->service && $this->service instanceof FileManagementService) {
            $fileData = array_first($this->service->uploadFileImages([$fileUpload]));
            $fileName = pathinfo($fileData['file_name'], PATHINFO_BASENAME);
            $fileInfo = $this->service->getFileImages($fileName);
            // $fileName = pathinfo('/bannersmtvnn_20230412121758_20240518220409.png', PATHINFO_BASENAME);
            // $fileInfo = $this->service->getFileImages($fileName);
            return ['location' => url($fileInfo['path'])];
        }
        return ['location' => null];
    }
}
