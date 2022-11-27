<?php
namespace Modules\Admin\Support;

use Modules\Admin\Services\MenuService;

class MenusSupport extends MenuService
{
    public function getMenuTypes()
    {
        return array_map(function($item) {
            return trans("admin::menus.{$item}");
        }, config('admin.menu_type'));
    }

    public function getPartialTypes()
    {
        return array_map(function($item) {
            return trans("admin::menus.partial.{$item}");
        }, config('admin.partial_type'));
    }

    public function getPartialTable($name)
    {
        return data_get(config('admin.menu_type'), $name);
    }
}
