<?php

namespace Modules\Admin\Grids;

use Modules\Admin\Facades\StatusType;

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
            // "parent_name",
            [
                'key' => 'category_name',
                'label' => trans('admin::categories.category_name'),
                'cell' => function($itemData) {
                    return str_repeat('-- ', $itemData['depth']).$itemData['category_name'];
                    // return StatusType::getStatusType($itemData['category_status']);
                }
            ],
            [
                'key' => 'category_link',
                'label' => trans('admin::categories.category_link')
            ],
            [
                'key' => 'category_status',
                'label' => trans('admin::categories.category_status'),
                'cell' => function($itemData) {
                    return StatusType::getStatusType($itemData['category_status']);
                }
            ]
		];
    }

    protected function getCreareUrl()
    {
        return route($this->getSectionCode().'.create', ['type' => request('category_type'),'ref' => $this->getId()]);
    }
}
