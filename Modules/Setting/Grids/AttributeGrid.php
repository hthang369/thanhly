<?php

namespace Modules\Setting\Grids;

use Modules\Core\Grids\BaseGrid;

class AttributeGrid extends BaseGrid
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
                    return str_repeat('-- ', $itemData['depth']).$itemData['key'];
                    // return StatusType::getStatusType($itemData['category_status']);
                }
            ],
        ];
    }
}
