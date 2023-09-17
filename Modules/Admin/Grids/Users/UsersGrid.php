<?php

namespace Modules\Admin\Grids\Users;

use Modules\Core\Grids\BaseGrid;

class UsersGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Users';

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
                'key' => 'username',
                'label' => trans('username'),
            ],
            [
                'key' => 'name',
                'label' => trans('name'),
            ],
            [
                'key' => 'email',
                'label' => trans('email'),
            ],
            [
                'key' => 'roles',
                'label' => trans('roles'),
                'formatter' => function($value, $key, $item) {
                    return collect($item[$key])->map(function($row) {
                        return '<span class="badge badge-primary">'.$row->name.'</span>';
                    })->join(' ');
                }
            ],
        ];
    }
}
