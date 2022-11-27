<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Traits\NestedSetMenuTrait;

class MenusModel extends AdminBaseModel
{
    use NestedSetMenuTrait;

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
        'menu_type'
    ];
}
