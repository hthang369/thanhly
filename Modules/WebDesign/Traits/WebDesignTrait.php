<?php
namespace Modules\WebDesign\Traits;

use Illuminate\Support\Facades\View;

trait WebDesignTrait
{
    public function sharePageTitle($title)
    {
        View::composer(module_view_name('layouts.master'), function($view) use($title) {
            $view->with('pageTitle', $title);
        });
    }
}