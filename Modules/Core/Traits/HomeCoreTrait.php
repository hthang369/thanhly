<?php
namespace Modules\Core\Traits;

use Illuminate\Support\Facades\View;

trait HomeCoreTrait
{
    public function shareDataToView($data)
    {
        $this->sharePageTitle(data_get($data, 'data.ob_title'));    
    }

    public function sharePageTitle($title)
    {
        View::composer(module_view_name('layouts.master'), function($view) use($title) {
            $view->with('pageTitle', $title);
        });
    }
}