<?php

namespace Modules\Api\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Api\Entities\NewsModel;

class NewsRepository extends NewsBaseRepository
{
    use NewsCriteria;
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
}
