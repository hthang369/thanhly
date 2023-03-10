<?php

namespace Modules\Core\Traits;

use Laka\Core\Traits\Entities\NestedSetTrait;

/*
 * A trait to handle use full text search
 */

trait NestedSetMenuTrait
{
    use NestedSetTrait;

    public function initializeNestedSetMenuTrait()
    {
        $this->setPrefixColumn('menu_');
        $this->setTitleColumn('name');
    }
}
