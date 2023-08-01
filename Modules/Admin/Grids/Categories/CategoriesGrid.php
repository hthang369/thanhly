<?php

namespace Modules\Admin\Grids\Categories;

use Modules\Core\Enums\DataType;
use Modules\Core\Grids\BaseGrid;

class CategoriesGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Categories';
    // protected $indexColumnOptions = ['visible' => false];
    protected $except = ['category_type'];
    /**
    * Set the columns to be displayed.
    *
    * @return void
    * @throws \Exception if an error occurs during parsing of the data
    */
    public function setColumns()
    {
        return [
            [
                'key' => 'category_name',
                'label' => trans('admin::categories.category_name'),
                'dataType' => DataType::NESTED_SET,
            ],
            [
                'key' => 'category_link',
                'label' => trans('admin::categories.category_link')
            ],
            [
                'key' => 'is_status',
                'label' => trans('admin::categories.is_status'),
                'dataType' => DataType::STATUS
            ]
		];
    }

    protected function getCreareUrl()
    {
        return $this->generateUrl('create', ['type' => request('category_type')]);
    }

    protected function getEditUrl($params)
    {
        return $params ? $this->generateUrl('edit', ['type' => request('category_type'), 'id' => $params]) : '';
    }
}
