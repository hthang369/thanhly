<?php

namespace Modules\WebDesign\Services;

use Illuminate\Support\Facades\Request;
use Laka\Core\Facades\Common;
use Modules\Admin\Repositories\Advertises\SlidesRepository;
use Modules\Admin\Repositories\Categories\CategoriesRepository;
use Modules\Admin\Repositories\Menus\MenusRepository;

class WebDesignServices
{
    public function getHeaderMenus()
    {
        return $this->getNavbarMenus('main', 'navbar_bt4');
    }

    public function getFooterMenus()
    {
        return $this->getNavbarMenus('footer');
    }

    public function getFooterOurMenus()
    {
        // return $this->getNavbarMenus('footer_our');
        $dataTree = resolve(CategoriesRepository::class)->getDataTreeByType('post');
        return Common::renderMenus($dataTree, 'navbar', '', true, function ($item) {
            return [
                'class' => 'text-uppercase',
                'link' => route('page.show-post', $item['link'])
            ];
        });
    }

    private function getNavbarMenus($type, $menu_style = '')
    {
        $dataTree = resolve(MenusRepository::class)->getDataByType($type);
        return Common::renderMenus($dataTree, 'navbar', $menu_style, true, function ($item) {
            return [
                'class' => 'nav-link',
                'active' => Request::is($item['link'])
            ];
        });
    }

    public function getCategoriesMenus()
    {
        $dataTree = resolve(CategoriesRepository::class)->getDataTreeByType('post');
        return Common::renderMenus($dataTree, 'navbar', 'sidebar_bt4', true, function ($item) {
            return [
                'class' => 'text-uppercase nav-link',
                'link' => route('page.show-post', $item['link'])
            ];
        });
    }

    public function getSiderMenus()
    {
        $results = resolve(SlidesRepository::class)->all();
        return $results->map(function ($item) {
            return [
                'image' => ['src' => vnn_asset('storage/images/' . $item->advertise_image), 'lazyload' => false, 'height' => 280]
            ];
        })->all();
    }
}
