<?php

namespace Modules\Core\Traits;

use Laka\Core\Traits\Entities\NestedSetTrait;

/*
 * A trait to handle use full text search
 */

trait NestedSetAttributeTrait
{
    use NestedSetTrait;

    public function initializeNestedSetAttributeTrait()
    {
        $this->setPrefixColumn('attr_');
    }
}
