<?php

namespace Modules\Admin\Entities;

use App\Models\Users\User;
use Spatie\Permission\Models\Role;
use Laka\Core\Traits\Entities\FullTextSearch;

class UsersModel extends User
{
    use FullTextSearch;

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
