<?php

namespace Modules\Core\Traits;

use Laka\Core\Traits\Entities\NestedSetTrait;

/*
 * A trait to handle use full text search
 */

trait NestedSetCategoryTrait
{
    use NestedSetTrait;

    public function initializeNestedSetCategoryTrait()
    {
        $this->setPrefixColumn('category_');
        $this->setTitleColumn('name');
    }
}
