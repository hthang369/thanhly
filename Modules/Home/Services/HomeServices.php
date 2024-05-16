<?php

namespace Modules\Home\Services;

use Illuminate\Support\Facades\Request;
use Laka\Core\Facades\Common;
use Modules\Admin\Repositories\Advertises\SlidesRepository;
use Modules\Admin\Repositories\Categories\CategoriesRepository;
use Modules\Admin\Repositories\Menus\MenusRepository;
use Modules\Core\Entities\Posts\PostsModel;
use Modules\Home\Repositories\CounterOnlineRepository;
use Modules\Home\Repositories\TotalOnlineRepository;
use Modules\Home\Repositories\UserOnlineRepository;
use Modules\Setting\Facade\Setting;

class HomeServices
{
    public function getHeaderMenus()
    {
        return $this->getNavbarMenus('main', 'navbarmenu', function($item) {
            return Request::is($item['link']) || in_array(get_route_name(), $item->route_name);
            // dd(get_route_name());
            // dd($item);
        });
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
                'link' => route('page.show-service', $item['link'])
            ];
        });
    }

    private function getNavbarMenus($type, $menu_style = '', $callback = null)
    {
        $dataTree = resolve(MenusRepository::class)->getDataByType($type);
        return Common::renderMenus($dataTree, 'navbar', $menu_style, true, function ($item) use($callback) {
            return [
                'class' => 'text-uppercase nav-link py-xl-0',
                'active' => function() use($item, $callback) {
                    if (!blank($callback) && is_callable($callback)) {
                        return with($item, $callback);
                    }
                    return Request::is($item['link']);
                }
            ];
        });
    }

    public function getCategoriesMenus($type)
    {
        $dataTree = resolve(CategoriesRepository::class)->getDataTreeByType($type);
        return Common::renderMenus($dataTree, 'navbar', 'navmenu_bt4', true, function ($item) {
            return [
                'class' => 'text-uppercase nav-link',
                'link' => route('page.show-service', $item['link']),
                'link_name' => $item['link']
            ];
        });
    }

    public function getSiderMenus()
    {
        $results = resolve(SlidesRepository::class)->all();
        return $results->map(function ($item) {
            return [
                'image' => ['src' => vnn_asset('storage/images/' . $item->advertise_image), 'lazyload' => false, 'height' => 400]
            ];
        })->all();
    }

    public function getPostPopulars()
    {
        return PostsModel::orderBy('post_date', 'desc')->limit(10)->get([
            'post_title as title',
            'post_link as link',
            'post_image as image'
         ])->transform(function($item) {
            $item->link = route('page.show-detail', $item->link);
            return $item;
         });
    }

    public function getAllSetting()
    {
        dd(Setting::all());
    }

    public function calculatorCounterAccessTime()
    {
        $tg = time();
        $tgout = 600;
        $tgnew = $tg - $tgout;
        $now = date("Y-m-d");
        $nowht = gmdate("H:i:s", $tg + 7 * 3600);
        $userOnlineRepo = resolve(UserOnlineRepository::class);
        $counterOnlineRepo = resolve(CounterOnlineRepository::class);
        $totalOnlineRepo = resolve(TotalOnlineRepository::class);
        $ip = request()->ip();
        $userOnlineRepo->create([
            'tgtmp' => $tg,
            'ip' => request()->ip(),
            'local' => request()->fullUrl(),
            'time' => $nowht
        ]);
        $userOnlineRepo->deleteTimestamp($tgnew);
        $isOnline = $userOnlineRepo->pluck('ip')->unique()->count();
        $todayOnline = $counterOnlineRepo->getTotalCounter($now);
        $totalForIp = $userOnlineRepo->getTotalDataIsIp($ip);
        if ($totalForIp == 1) {
            $counterOnlineRepo->create([
                'counter' => 1,
                'date' => $now
            ]);
        }
        $totalLessNow = $counterOnlineRepo->getTotalCounterLessNow($now);
        $result = $totalOnlineRepo->pluck('sum', 'id')->toArray();
        $id = key($result);
        $totalOnline = head($result);
        if ($totalLessNow > 0) {
            $totalOnlineRepo->update([
                'sum' => $totalOnline + $totalLessNow,
                'date' => $now
            ], $id);
            $counterOnlineRepo->deleteTimestamp($now);
        }

        return compact('isOnline', 'todayOnline', 'totalOnline');
    }
}
