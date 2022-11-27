<?php

namespace Modules\Admin\Facades;

use Illuminate\Support\Facades\Facade;

class StatusType extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'status-type-helper';
    }
}
