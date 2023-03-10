<?php
namespace Modules\Setting\Traits;

use Laka\Core\Traits\Entities\NestedSetTrait;

trait NestedSetAttributeTrait
{
    use NestedSetTrait;

    public function initializeNestedSetAttributeTrait()
    {
        $this->setPrefixColumn('attr_');
    }
}