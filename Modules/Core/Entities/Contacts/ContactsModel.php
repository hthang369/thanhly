<?php

namespace Modules\Core\Entities\Contacts;

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
