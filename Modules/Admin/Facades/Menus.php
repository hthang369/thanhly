<?php

namespace Modules\Admin\Facades;

use Illuminate\Support\Facades\Facade;

class Menus extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'menus-support';
    }
}
