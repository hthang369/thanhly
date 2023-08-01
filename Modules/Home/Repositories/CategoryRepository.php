<?php

namespace Modules\Home\Repositories;

use Modules\Admin\Enums\CategoryType;
use Modules\Core\Entities\Brands\BrandsModel;
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
            'relations' => ['currency', 'promotions']
        ], 
        CategoryType::NEWS => [
            'method' => 'news',
            'limit' => 15,
            'relations' => []
        ]
    ];

    public function showCategory($id, $viewName)
    {
        $info = $this->model->with('children')->find($id);
        $info->header_title = $info->category_name;
        $relation = data_get($this->lstWithRelations, $info->category_type);
        $this->loadRelation($info, $relation);
        $this->loadLimitRelation($info->children, $relation);
        return [
            'view_name' => $viewName ?? $info->view_name ?? 'category',
            'data' => $info
        ];
    }

    public function showInternal($id, $viewName)
    {
        $info = $this->model->firstWhere('category_link', $id);
        $info->header_title = $info->category_name;
        $relation = data_get($this->lstWithRelations, $info->category_type);
        $this->loadRelation($info, $relation);
        return [
            'view_name' => $viewName ?? 'category.index',
            'data' => $info
        ];
    }

    public function showCategoryBrand($title, $brand)
    {
        $info = $this->model->with(['brands' => function($query) use($brand) {
            return $query->where('brand_link', $brand);
        }])->firstWhere('category_link', $title);
        $info->header_title = $info->category_name;
        $relation = data_get($this->lstWithRelations, $info->category_type);
        $this->loadRelation($info, $relation, function($query, $with) use($brand) {
            return $query->whereHas('brand', function($subQuery) use($brand) {
                return $subQuery->where('brand_link', $brand);
            });
        });
        return [
            'view_name' => $viewName ?? 'category.index',
            'data' => $info
        ];
    }

    protected function loadRelation(&$data, $relationInfo, $callback = null)
    {
        $method = data_get($relationInfo, 'method');
        $limit = data_get($relationInfo, 'limit');
        $with = data_get($relationInfo, 'relations');
        return $data->loadPaginate([$method => function($query) use($with, $callback) {
            $query->with($with);
            if (!blank($callback) && is_callable($callback)) {
                $query = call_user_func($callback, $query, $with);
            }
            return $query;
        }], $limit);
    }

    protected function loadLimitRelation(&$data, $relationInfo)
    {
        $method = data_get($relationInfo, 'method');
        $limit = data_get($relationInfo, 'limit');
        $with = data_get($relationInfo, 'relations');
        return $data->load([$method => function($query) use($with, $limit) {
            return $query->with($with)->whereBetween('pivot_idx', [1, $limit]);
        }]);
    }

    public function loadAllBrands()
    {
        return BrandsModel::all();
    }
}
