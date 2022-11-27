<?php

namespace Modules\Admin\Services;

use Illuminate\Support\Facades\Route;
use Laka\Core\Facades\Common;
use Modules\Admin\Entities\MenusModel;

class MenuService
{
    public function getHeaderMenus()
    {
        $dataTree = MenusModel::where('menu_type', 'main')->defaultOrder()->get()->toTree();
        return Common::renderMenus($dataTree, 'navbar', 'navbar_bt4');
    }

    public function getFooterMenus()
    {
        $dataTree = MenusModel::where('menu_type', 'footer')->defaultOrder()->get()->toTree();
        return Common::renderMenus($dataTree, 'navbar');
    }

    public function getAdminSlidebars()
    {
        $results = config('admin.menus');

        $dataTree = $this->setActiveVisiableMenus($results);

        return Common::renderMenus(collect($dataTree), 'slidebar', 'slidebar_bt4');
    }

    private function setActiveVisiableMenus(&$results)
    {
        return array_map(function($item) {
            $item['visiable'] = Route::has($item['menu_link']) && user_can('view_'.$item['section']);
            if ($item['visiable']) {
                $item['actived'] = request()->routeIs($item['menu_name']);
                $item['link'] = empty($item['menu_link']) ? '#' : route($item['menu_link']);
                $item['title'] = trans($item['menu_title']);
                $item['icon'] = $item['menu_icon'];
                $item['id'] = data_get($item, 'menu_id');
            }
            if (count($item['children']) > 0) {
                $item['children'] = $this->setActiveVisiableMenus($item['children']);
                return $item;
            }
            return $item;
        }, $results);
    }

    public function getSortableMenus($dataTree)
    {
        return Common::renderMenus($dataTree, 'nestedSortable', 'nested_sortable_bt4', false, function($item) {
            return [
                'id' => 'item_'.data_get($item, 'id')
            ];
        });
    }

}
