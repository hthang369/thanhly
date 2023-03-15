<?php

namespace Modules\WebDesign\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Setting\Facade\Setting;
use Modules\WebDesign\Services\WebDesignServices;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (domain_is(env('SECOND_DOMAIN')) && isset($_SERVER['REQUEST_URI'])) {
            $moduleName = head(array_filter(explode('/',$_SERVER['REQUEST_URI'])));
            if (!in_array($moduleName, ['admin', 'login', 'register'])) {
                $service = resolve(WebDesignServices::class);
                $allSetting = Setting::getAllSetting();
                View::composer('webdesign::layouts.master', function($view) use($allSetting) {
                    $view->with('webFavicon', data_get($allSetting, 'home.web_favicon'));
                });
                View::composer('webdesign::layouts.preview_master', function($view) use($allSetting) {
                    $view->with('webLogo', data_get($allSetting, 'home.web_logo'));
                    $view->with('webFavicon', data_get($allSetting, 'home.web_favicon'));
                });
                View::composer('webdesign::contact', function($view) use($allSetting) {
                    $view->with('infoSettings', $allSetting->only(['info', 'map']));
                });
                View::composer('webdesign::partial.header', function ($view) use($service, $allSetting) {
                    $view->with('menus', $service->getHeaderMenus());
                    $view->with('webLogo', data_get($allSetting, 'home.web_logo'));
                });
                View::composer('webdesign::partial.footer', function ($view) use($service, $allSetting) {
                    $view->with('footerMenu', $service->getFooterMenus());
                    $view->with('footerOurMenu', $service->getFooterOurMenus());
                    $view->with('infoSettings', $allSetting->only(['info', 'home']));
                });
                View::composer('webdesign::partial.left', function ($view) use($service) {
                    $view->with('categoriesMenus', $service->getCategoriesMenus());
                });
                View::composer('webdesign::partial.menuside', function ($view) use($service) {
                    $view->with('slides', $service->getSiderMenus());
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
