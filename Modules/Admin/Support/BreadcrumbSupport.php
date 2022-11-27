<?php
namespace Modules\Admin\Support;

use Illuminate\Support\Fluent;

class BreadcrumbSupport extends Fluent
{
    public function add($key, $value)
    {
        $this->{$key} = $value;
    }
}
