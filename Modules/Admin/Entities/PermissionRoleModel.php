<?php

namespace Modules\Admin\Entities;

class PermissionRoleModel extends AdminBaseModel
{
    protected $table = 'role_has_permissions';

    protected $fillable = [
        'name',
        'age'
    ];
}
