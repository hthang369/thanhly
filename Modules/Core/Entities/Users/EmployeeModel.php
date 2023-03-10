<?php

namespace Modules\Core\Entities\Users;

use Modules\Core\Entities\CoreModel;

class EmployeeModel extends CoreModel
{
    protected $table = 'employees';

    protected $fillable = [
        'employee_no',
        'first_name',
        'last_name',
        'avatar',
        'birthday',
        'gender',
        'phone_number',
        'email_address'
    ];
}
