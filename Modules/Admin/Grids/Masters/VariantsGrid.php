<?php

namespace Modules\Admin\Grids\Masters;

use Modules\Core\Grids\BaseGrid;

class VariantsGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Variants';

    /**
    * Set the columns to be displayed.
    *
    * @return void
    * @throws \Exception if an error occurs during parsing of the data
    */
    public function setColumns()
    {
        return [
            'variant_name',
            'variant_color',
            'is_status'
        ];
    }
}
