<?php

namespace Modules\Admin\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\CategoriesModel;
use Modules\Admin\Forms\CategoriesForm;
use Modules\Admin\Grids\CategoriesGrid;
use Laka\Core\Repositories\FilterQueryString\Filters\WhereClause;

class CategoriesRepository extends AdminBaseRepository
{
    protected $presenterClass = CategoriesGrid::class;

    protected $filters = [
        'category_type' => WhereClause::class
    ];

    protected $except = ['category_type'];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CategoriesModel::class;
    }

    /**
     * Specify Form class name
     *
     * @return string
     */
    public function form()
    {
        return CategoriesForm::class;
    }

    public function create(array $attributes)
    {
        if (!isset($attributes['category_status']))
            $attributes['category_status'] = 1;
        if (blank($attributes['category_link']))
            $attributes['category_link'] = str_slug($attributes['category_name']);

        return parent::createNestedTree($attributes);
    }

    public function update(array $attributes, $id)
    {
        if (!isset($attributes['category_status']))
            $attributes['category_status'] = 1;
        if (blank($attributes['category_link']))
            $attributes['category_link'] = str_slug($attributes['category_name']);

        return parent::updateNestedTree($attributes, $id);
    }

    public function getListOfLink()
    {
        return parent::pluck('category_name', 'id');
    }

    public function formGenerate($route, $actionName, $config = [])
    {
        return parent::formGenerate($route, $actionName, array_merge($config, ['type' => request('category_type')]));
    }

    public function allDataGrid()
    {
        return $this->allNestedDataGrid();
    }

    public function getDataTreeByType($type)
    {
        return $this->model->where('category_type', $type)->defaultOrder()->get([
            'id',
            'category_name as title',
            'category_link as link',
            DB::raw("'' as icon"),
            'parent_id',
            'category_lft',
            'category_rgt'
        ])->toTree();
    }
}
