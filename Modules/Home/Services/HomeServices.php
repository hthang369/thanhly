<?php

namespace Modules\Home\Services;

use Illuminate\Support\Facades\Request;
use Laka\Core\Facades\Common;
use Modules\Admin\Repositories\CategoriesRepository;
use Modules\Admin\Repositories\MenusRepository;
use Modules\Admin\Repositories\SlidesRepository;
use Modules\Home\Repositories\CounterOnlineRepository;
use Modules\Home\Repositories\TotalOnlineRepository;
use Modules\Home\Repositories\UserOnlineRepository;

class HomeServices
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
                'class' => 'text-uppercase nav-link',
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
                'image' => ['src' => asset('public/storage/images/' . $item->advertise_image), 'lazyload' => false, 'height' => 280]
            ];
        })->all();
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
