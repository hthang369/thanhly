<?php

namespace Modules\Admin\Grids\Pages;

use Modules\Admin\Grids\BasePageGrid;
use Modules\Core\Enums\DataType;

class PagesGrid extends BasePageGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Pages';

    protected $modalSize = 'modal-xl';

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
                'key' => 'post_title',
                'label' => trans('admin::posts.post_title')
            ],
            [
                'key' => 'post_excerpt',
                'label' => trans('admin::posts.post_excerpt'),
            ],
            [
                'key' => 'post_date',
                'label' => trans('admin::posts.post_date'),
            ],
            [
                'key' => 'is_status',
                'label' => trans('admin::posts.is_status'),
                'dataType' => DataType::STATUS
            ],
        ];
    }
}
