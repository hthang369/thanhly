<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Modules\Admin\Facades\Breadcrumb;
use Laka\Core\Facades\Common;

class InfoWeb
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $sectionCode = Common::getSectionCode();
        $routeName = Route::currentRouteName();
        $parentLink = config("admin.breadcrumb.{$routeName}.parent");
        $currentLink = config("admin.breadcrumb.{$routeName}.link");
        $dashboardName = '<i class="fa fa-home"></i>';
        $currentName = __("admin::menus.{$sectionCode}");
        $pageTitle = $sectionCode;
        if (!is_null($parentLink)) {
            foreach($parentLink as $link) {
                $name = head(explode('.', $link));
                $parentName = __("admin::menus.{$name}");
                if (str_is($name, 'admin')) {
                    $parentName = $dashboardName;
                } else if (str_is($name, $sectionCode)) {
                    $currentName = __("admin::menus.".@end(explode('.', $routeName)));
                }
                Breadcrumb::add($parentName, route($link));
            }
        }
        if (str_is($sectionCode, 'admin')) {
            $pageTitle = 'dashboard';
            $currentName = $dashboardName;
        }
        Breadcrumb::add($currentName, $currentLink);
        View::share('page_title', "admin::menus.page_title.$pageTitle");
        return $next($request);
    }
}
