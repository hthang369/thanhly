<?php
namespace Modules\Core\Traits;

use Illuminate\Support\Facades\View;

trait HomeCoreTrait
{
    public function sharePageTitle($title)
    {
        View::composer(module_view_name('layouts.master'), function($view) use($title) {
            $view->with('pageTitle', $title);
        });
    }
}