<?php

namespace Modules\Admin\Grids\Pages;

use Modules\Admin\Facades\StatusType;
use Modules\Core\Enums\DataType;
use Modules\Core\Grids\BaseGrid;

class PagesGrid extends BaseGrid
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
                'key' => 'post_status',
                'label' => trans('admin::posts.post_status'),
                'dataType' => DataType::STATUS
            ],
        ];
    }
}
