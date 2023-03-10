<?php

namespace Modules\Admin\Grids\Posts;

use Modules\Core\Enums\DataType;
use Modules\Core\Grids\BaseGrid;

class PostsGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Posts';

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
                'key' => 'post_image',
                'label' => trans('admin::posts.post_image'),
                'dataType' => DataType::IMAGE
            ],
            [
                'key' => 'category_id',
                'label' => trans('admin::posts.category_id'),
                'formatter' => function($value, $key, $item) {
                    return $value->pluck('category_name')->join(', ');
                }
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
