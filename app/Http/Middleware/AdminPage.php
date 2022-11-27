<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Common\Services\Menu\MenuService;

class AdminPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $service = resolve(MenuService::class);
        $menus = $service->getMenuByPermission();
        $notifications = $service->getNotifications();
        view()->share('MENUS', $menus);
        view()->share('NOTIFICATIONS', $notifications);
        view()->share('showLogo', true);
        
        return $next($request);
    }
}
