<?php

namespace Modules\Admin\Entities;

use Laka\Core\Entities\BaseModel;

class ContactsModel extends BaseModel
{
    protected $table = 'contacts';

    protected $fillable = [
        'subject',
        'fullname',
        'email',
        'phone',
        'address',
        'gender',
        'content'
    ];

    protected $fillableColumns = [
        'id',
        'subject',
        'fullname',
        'email',
        'phone'
    ];
}
