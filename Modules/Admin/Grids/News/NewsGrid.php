<?php

namespace Modules\Admin\Grids\News;

use Modules\Admin\Facades\StatusType;
use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Core\Enums\DataType;
use Modules\Core\Grids\BaseGrid;

class NewsGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'News';

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
                'label' => trans('admin::posts.post_title'),
            ],
            [
                'key' => 'post_image',
                'label' => trans('admin::posts.post_image'),
                'dataType' => DataType::IMAGE
            ],
            [
                'key' => 'category_id',
                'label' => trans('admin::posts.category_id'),
                'lookup' => [
                    'dataSource' => CategoriesModel::get(['category_name', 'id'])->toArray(),
                    'valueExpr' => 'id',
                    'displayExpr' => 'category_name'
                ],
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
