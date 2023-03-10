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

    public function getDataSourceTabPartialTypes()
    {
        $partialTypes = $this->getPartialTypes();
        return collect($partialTypes)->map(function($item, $key) {
            return [
                'value' => $key,
                'text' => $item,
                'data-bs-toggle' => 'tab',
                'data-bs-target' => "#{$key}_tab",
                'role' => 'tab',
                'aria-controls' => "{$key}_tab",
                'aria-selected' => false
            ];
        })->values();
    }
}
