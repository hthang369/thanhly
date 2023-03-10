<?php

namespace Modules\Home\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Home\Services\HomeServices;
use Modules\Setting\Facade\Setting;
use Nwidart\Modules\Facades\Module;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (domain_is(env('FIRST_DOMAIN')) && isset($_SERVER['REQUEST_URI'])) {
            $moduleName = head(array_filter(explode('/',$_SERVER['REQUEST_URI'])));
            if (!in_array($moduleName, ['admin', 'login', 'register'])) {
                $service = resolve(HomeServices::class);
                $allSetting = Setting::getAllSetting();
                View::composer('*', function($view) use($allSetting) {
                    $view->with('infoSettings', $allSetting->only(['info', 'home']));
                });
                View::composer('home::partial.header', function ($view) use($service) {
                    $view->with('menus', $service->getHeaderMenus());
                });
                View::composer('home::partial.footer', function ($view) use($service) {
                    $view->with('footerMenu', $service->getFooterOurMenus());
                });
                View::composer('home::partial.left', function ($view) use($service) {
                    $view->with('categoriesMenus', $service->getCategoriesMenus());
                });
                View::composer('home::partial.menuside', function ($view) use($service) {
                    $view->with('slides', $service->getSiderMenus());
                });
                View::composer('home::partial.counter', function ($view) use($service) {
                    $view->with('visitOnline', $service->calculatorCounterAccessTime());
                });
            }
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
