<?php

namespace Modules\Admin\Grids\Products;

use Modules\Core\Grids\BaseGrid;

class ProductsGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Products';

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
                'key' => 'sku'
            ],
            [
                'key' => 'name'
            ],
            [
                'key' => 'category_id',
                'label' => trans('admin::posts.category_id'),
                'formatter' => function($value, $key, $item) {
                    return $value->pluck('category_name')->join(', ');
                }
            ],
            [
                'key' => 'price'
            ],
            [
                'key' => 'except'
            ],

        ];
    }
}
