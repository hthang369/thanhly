<?php

namespace Modules\Home\Facades;

use Illuminate\Support\Facades\Facade;

class Portfolio extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'portfolio-support';
    }
}
