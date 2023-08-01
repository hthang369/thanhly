<?php

namespace Modules\Setting\Grids\Attributes;

use Modules\Core\Grids\BaseGrid;

class AttributesGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Attribute';

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
                'key' => 'key',
                'label' => trans('setting::attributes.key'),
                'cell' => function($itemData) {
                    return str_repeat('-- ', $itemData['depth']).trans($itemData['language']);
                    // return StatusType::getStatusType($itemData['category_status']);
                }
            ],
        ];
    }
}
