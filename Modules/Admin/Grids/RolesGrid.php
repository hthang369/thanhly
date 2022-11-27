<?php

namespace Modules\Admin\Grids;

use Illuminate\Support\HtmlString;

class RolesGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Roles';

    /**
    * Set the columns to be displayed.
    *
    * @return void
    * @throws \Exception if an error occurs during parsing of the data
    */
    public function setColumns()
    {
        return [
		    "level",
            [
                'key' => 'name',
                'cell' => function($item) {
                    return new HtmlString(sprintf('<a href="%s">%s</a>', route('role_has_permissions.show',$item['id']), $item['name']));
                }
            ],
		    "role_rank",
		    "users_count"
		];
    }
}
