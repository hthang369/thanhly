<?php

namespace Modules\Admin\Grids;

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
                'cell' => function($itemData) {
                    return collect($itemData['role_list'])->map(function($item) {
                        return '<span class="badge badge-primary">'.$item.'</span>';
                    })->join(' ');
                }
            ],
        ];
    }
}
