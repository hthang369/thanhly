<?php
namespace Modules\Core\Mixins;

use Laka\Core\Enums\ActionStatus;
use Modules\Core\Enums\ActionHot;

class BlueprintMixin
{
    // add column schema
    public function domain()
    {
        return function($column = 'domain_at') {
            $this->unsignedInteger($column);
        };
    }

    public function status()
    {
        return function($column = 'is_status') {
            $this->enum($column, ActionStatus::listConstains());
        };
    }

    public function ishot()
    {
        return function($column = 'is_hot') {
            $this->enum($column, ActionHot::listConstains());
        };
    }

    // drop column schema
    public function dropDomain()
    {
        return function($column = 'domain_at') {
            $this->dropColumn($column);
        };
    }

    public function dropStatus()
    {
        return function($column = 'is_status') {
            $this->dropColumn($column);
        };
    }

    public function dropIshot()
    {
        return function($column = 'is_hot') {
            $this->dropColumn($column);
        };
    }
}