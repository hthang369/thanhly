<?php

namespace Modules\Admin\Grids\Uoms;

use Modules\Core\Grids\BaseGrid;

class UomsGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Uoms';

    /**
    * Set the columns to be displayed.
    *
    * @return void
    * @throws \Exception if an error occurs during parsing of the data
    */
    public function setColumns()
    {
        return [
            'uom_name'
        ];
    }
}
