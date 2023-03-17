<?php

namespace Modules\WebDesign\Repositories;

use Modules\Admin\Enums\CategoryType;
use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Core\Repositories\HomeCoreRepository;

class CategoryRepository extends HomeCoreRepository
{
    protected $modelClass = CategoriesModel::class;

    protected $lstWithRelations = [
        CategoryType::POST => [
            'method' => 'posts',
            'limit' => 8,
            'relations' => []
        ], 
        CategoryType::PRODUCT => [
            'method' => 'products',
            'limit' => 8,
            'relations' => ['images']
        ], 
        CategoryType::NEWS => [
            'method' => 'news',
            'limit' => 15,
            'relations' => []
        ]
    ];

    public function showCategory($id, $viewName)
    {
        $info = $this->find($id);
        $relation = data_get($this->lstWithRelations, $info->category_type);
        $this->loadRelation($info, $relation);
        $childrens = $this->model->withCategoryType($info->category_type)->whereIsAfter($id)->defaultOrder()->get()->toTree();
        $childrens->transform(function($item) use($relation) {
            return $this->loadRelation($item, $relation);
        });
        $info->setRelation('children', $childrens);
        return [
            'view_name' => $viewName ?? $info->view_name ?? 'category',
            'data' => $info
        ];
    }

    protected function loadRelation(&$data, $relationInfo)
    {
        $method = data_get($relationInfo, 'method');
        $limit = data_get($relationInfo, 'limit');
        $with = data_get($relationInfo, 'relations');
        return $data->loadPaginate([$method => function($query) use($with) {
            return $query->with($with);
        }], $limit);
    }

    public function findPost($id)
    {
        # code...
    }

    // public function findProduct($id)
    // {
    //     # code...
    // }
}
