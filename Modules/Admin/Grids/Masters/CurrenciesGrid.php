<?php

namespace Modules\Admin\Grids\Masters;

use Modules\Core\Grids\BaseGrid;

class CurrenciesGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Currencies';

    /**
    * Set the columns to be displayed.
    *
    * @return void
    * @throws \Exception if an error occurs during parsing of the data
    */
    public function setColumns()
    {
        return [
            'currency_no',
            'currency_name'
        ];
    }
}
