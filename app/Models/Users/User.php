<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laka\Core\Traits\Entities\SearchableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles, LogsActivity, SearchableTrait;

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'phone',
        'address',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $fillableColumns = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'status'
    ];

    protected static $logAttributes = ['*'];

    public function getIsUserSaAttribute()
    {
        return $this->status == 1 ? true : false;
    }
    public function getHighestRoleAttribute()
    {
        return $this->roles()->min('role_rank');
    }

    public function getIsSuperAdminAttribute()
    {
        return $this->roles->where('level', 'L1')->isNotEmpty();
    }
}
