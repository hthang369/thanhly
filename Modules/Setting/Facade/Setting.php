<?php

namespace Modules\Setting\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class Setting
 * @package Modules\Setting\Facade
 *
 * @method static string \Modules\Setting\Support\SettingSupport get($setting, $settingDetail = null, $default = null)
 * @method static string \Modules\Setting\Support\SettingSupport getLocalTimezone()
 */
class Setting extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'setting';
    }
}
