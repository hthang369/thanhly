<?php

namespace Modules\Core\Entities\Menus;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Entities\CoreModel;
use Modules\Core\Traits\NestedSetMenuTrait;

class MenusModel extends CoreModel
{
    use NestedSetMenuTrait, SoftDeletes;

    protected $table = 'menus';

    protected $fillable = [
        'menu_name',
        'menu_link',
        'parent_id',
        'menu_lft',
        'menu_rgt',
        'menu_icon',
        'partial_id',
        'partial_table',
        'menu_type',
        'route_name'
    ];

    protected $casts = [
        'route_name' => 'array'
    ];
}
