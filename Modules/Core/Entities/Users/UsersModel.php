<?php

namespace Modules\Core\Entities\Users;

use App\Models\Users\User;
use Spatie\Permission\Models\Role;
use Laka\Core\Traits\Entities\SearchableTrait;

class UsersModel extends User
{
    use SearchableTrait;

    protected $table = 'users';

    public function getRoles()
    {
        return $this->belongsToMany(Role::class, config('permission.table_names.model_has_roles'), config('permission.column_names.model_morph_key'));
    }

    public function getRoleListAttribute()
    {
        return $this->getRoles()->pluck('name');
    }
}
