<?php

namespace Modules\Admin\Grids\Tags;

use Modules\Core\Grids\BaseGrid;

class TagsGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Tags';

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
                'key' => 'name',
                'label' => 'Ten tu khoa'
            ]
        ];
    }
}
