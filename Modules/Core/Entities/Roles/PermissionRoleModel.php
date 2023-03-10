<?php

namespace Modules\Core\Entities\Roles;

use Laka\Core\Entities\BaseModel;

class PermissionRoleModel extends BaseModel
{
    protected $table = 'role_has_permissions';

    protected $fillable = [
        'name',
        'age'
    ];
}
