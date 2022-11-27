<?php

namespace Modules\Admin\Grids;

class AdvertisesGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'advertises';

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
                'cell' => function($itemData) {
                    return sprintf('<img src="%s" class="img-responsive" alt = "%s" width="80">', vnn_asset('storage/images/'.$itemData['advertise_image']), 'alternative');
                }
            ],
        ];
    }
}
