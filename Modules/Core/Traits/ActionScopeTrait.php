<?php

namespace Modules\Core\Traits;

use Laka\Core\Enums\ActionStatus;
use Modules\Core\Enums\ActionHot;
use Modules\Core\Enums\PostType;

trait ActionScopeTrait 
{
    public function scopeWhereActive($query, $columnName)
    {
        return $query->where($columnName, ActionStatus::ACTIVE);
    }

    public function scopeWhereIsHot($query, $columnName)
    {
        return $query->where($columnName, ActionHot::HOT);
    }

    public function scopeWhereDocType($query, $columnName, $type)
    {
        return $query->where($columnName, $type);
    }

    public function scopeWhereIsPost($query)
    {
        return $query->whereDocType('post_type', PostType::POST);
    }

    public function scopeWhereIsPage($query)
    {
        return $query->whereDocType('post_type', PostType::PAGE);
    }

    public function scopeWhereIsNews($query)
    {
        return $query->whereDocType('post_type', PostType::NEWS);
    }
}