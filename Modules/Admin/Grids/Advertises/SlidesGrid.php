<?php

namespace Modules\Admin\Grids\Advertises;

use Modules\Core\Enums\DataType;
use Modules\Core\Grids\BaseGrid;

class SlidesGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Slides';

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
                'key' => 'advertise_name',
                'label' => trans('admin::adverties.advertise_name'),
            ],
            [
                'key' => 'advertise_link',
                'label' => trans('admin::adverties.advertise_link'),
            ],
            [
                'key' => 'advertise_image',
                'label' => trans('admin::adverties.advertise_image'),
                'dataType' => DataType::IMAGE
            ],
		];
    }
}
