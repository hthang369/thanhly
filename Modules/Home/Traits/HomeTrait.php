<?php
namespace Modules\Home\Traits;

use Illuminate\Support\Facades\View;
use Modules\Home\Services\HomeServices;

trait HomeTrait
{
    public function sharePageTitle($title) 
    {
        View::composer(module_view_name('layouts.master'), function($view) use($title) {
            $view->with('pageTitle', $title);
        });
    }

    public function shareDataView($type, $shareKey = null, $shareValue = null)
    {
        View::composer(module_view_name('partial.right'), function($view) use($type, $shareKey, $shareValue) {
            $view->with('header', module_trans('common.slidebar_right.header'));
            $view->with('slidebar', resolve(HomeServices::class)->getCategoriesMenus($type));
            if (!blank($shareKey) && !blank($shareValue)) {
                $view->with($shareKey, $shareValue);
            }
        });
    }
}