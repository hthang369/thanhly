<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Facades\Breadcrumb;
use Modules\Admin\Services\MenuService;
use Laka\Core\Facades\Common;

class ComposerServiceProvider extends ServiceProvider
{
    protected $viewComposers = [
        \Modules\Admin\Http\ViewComposers\MenuComposer::class,
        \Modules\Admin\Http\ViewComposers\BreadcrumbComposer::class,
    ];
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view) {
            $view->with('sectionCode', Common::getSectionCode());
        });
        View::composer('admin::partial.breadcrumb', function($view) {
            $view->with('breadcrumb', Breadcrumb::toArray());
        });
        View::composer('admin::partial.sidebar', function($view) {
            $view->with('slidebar', resolve(MenuService::class)->getAdminSlidebars());
        });
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
