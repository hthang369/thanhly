<?php

namespace Modules\Admin\Grids\Masters;

use Modules\Core\Grids\BaseGrid;

class PromotionsGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Promotions';

    /**
    * Set the columns to be displayed.
    *
    * @return void
    * @throws \Exception if an error occurs during parsing of the data
    */
    public function setColumns()
    {
        return [
            'promotion_name',
            'promotion_value',
            'promotion_type'
        ];
    }
}
