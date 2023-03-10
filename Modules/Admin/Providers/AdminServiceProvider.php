<?php

namespace Modules\Admin\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\App;
use Modules\Admin\Support\BreadcrumbSupport;
use Modules\Admin\Support\MenusSupport;
use Modules\Admin\Support\StatusTypeHelper;
use Laka\Core\BaseServiceProvider;

class AdminServiceProvider extends BaseServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Admin';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'admin';

    protected $moduleNamespace = 'Modules\\Admin\\';

    protected $facades = [
        'menus-support' => MenusSupport::class,
        'breadcrumb-support' => BreadcrumbSupport::class,
        'status-type-helper' => StatusTypeHelper::class
    ];

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->modulePath = module_path($this->moduleName);
        $this->commandPath = module_path($this->moduleName, 'Console');
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->registerCommands();

        App::setlocale('vi');
        Blueprint::macro('seoMeta', function ($column = null) {
            $listColumn = ['ob_title' => 65, 'ob_keyword' => 160, 'ob_description' => 250];
            if (!blank($column)) {
                $listColumn = array_reverse($listColumn);
            }
            foreach($listColumn as $col => $val) {
                $this->string($col, $val)->after($column);
            }
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(ComposerServiceProvider::class);
        parent::register();
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/menus.php'), $this->moduleNameLower.'.menus'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
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

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
