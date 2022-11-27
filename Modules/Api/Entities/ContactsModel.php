<?php

namespace Modules\Api\Entities;

class ContactsModel extends ContactsBaseModel
{
    protected $table = 'api';

    protected $fillable = [
        'name',
        'age'
    ];
}
