<?php

namespace Modules\Admin\Repositories\Categories;

use Illuminate\Support\Facades\DB;
use Laka\Core\Enums\ActionStatus;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereClause;
use Modules\Admin\Forms\Categories\CategoriesForm;
use Modules\Admin\Grids\Categories\CategoriesGrid;
use Modules\Admin\Repositories\AdminBaseRepository;
use Modules\Core\Entities\Categories\CategoriesBrandsModel;
use Modules\Core\Entities\Categories\CategoriesModel;

class CategoriesRepository extends AdminBaseRepository
{
    protected $presenterClass = CategoriesGrid::class;

    protected $modelClass = CategoriesModel::class;

    protected $formClass = CategoriesForm::class;

    protected $filters = [
        'category_type' => WhereClause::class
    ];

    protected $except = ['category_type'];

    public function create(array $attributes)
    {
        return DB::transaction(function() use($attributes) {
            $model = parent::createNestedTree($attributes);
            if (isset($attributes['brands'])) {
                $this->upsertForenignColumn(CategoriesBrandsModel::class, $attributes['brands'], $model->id, 'brand_id');
            }
            return $model;
        });
    }

    public function update(array $attributes, $id)
    {
        return DB::transaction(function() use($attributes, $id) {
            $model = parent::updateNestedTree($attributes, $id);
            if (isset($attributes['brands'])) {
                $this->upsertForenignColumn(CategoriesBrandsModel::class, $attributes['brands'], $model->id, 'brand_id');
            }
            return $model;
        });
    }

    public function getListOfLink()
    {
        return parent::pluck('category_name', 'id');
    }

    public function formGenerate($route, $actionName, $config = [])
    {
        return parent::formGenerate($route, $actionName, array_merge($config, ['type' => request('category_type')]));
    }

    public function getDataTreeByType($type)
    {
        return $this->model->where('category_type', $type)->withoutRoot()->defaultOrder()->get([
            'id',
            'category_name as title',
            'category_link as link',
            DB::raw("'' as icon"),
            'parent_id',
            'category_lft',
            'category_rgt'
        ])->toTree();
    }

    public function getDataByType($type)
    {
        $results = $this->model->where('category_type', $type)
            ->defaultDepthNestedTree()->addSelect('categories.category_name as name')->get();
        return $this->parseSelectedNestedList($results);
    }
}
