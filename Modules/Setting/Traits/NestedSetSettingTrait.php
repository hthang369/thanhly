<?php
namespace Modules\Setting\Traits;

use Laka\Core\Traits\Entities\NestedSetTrait;

trait NestedSetSettingTrait
{
    use NestedSetTrait;

    public function initializeNestedSetSettingTrait()
    {
        $this->setPrefixColumn('setting_');
    }
}