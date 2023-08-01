<?php
namespace Modules\Home\Traits;

use Illuminate\Support\Facades\View;

trait HomeTrait
{
    public function shareDataView($shareKey = null, $shareValue = null, $viewName = null)
    {
        View::composer(module_view_name($viewName ?? 'partial.right'), function($view) use($shareKey, $shareValue) {
            if (is_string($shareKey) && !blank($shareKey) && !blank($shareValue)) {
                $view->with($shareKey, $shareValue);
            } else if (is_array($shareKey)) {
                foreach ($shareKey as $key => $value) {
                    $view->with($key, $value);
                }
            }
        });
    }
}