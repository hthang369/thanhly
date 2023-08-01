<?php

namespace Modules\Core\Traits;

use Illuminate\Database\Eloquent\Model;
use Laka\Core\Enums\ActionStatus;
use Modules\Core\Enums\ActionHot;
use Modules\Core\Enums\PostType;
use Modules\Core\Traits\Scopes\ActionStatusScope;

trait ActionScopeTrait 
{
    public static function bootActionScopeTrait()
    {
        static::addGlobalScope(new ActionStatusScope);
        static::saving(function(Model $model) {
            $model->setAttribute($model->getQualifiedIsStatusColumn(), ActionStatus::ACTIVE);
        });
    }

    public function initializeActionScopeTrait()
    {
        $this->mergeFillable([$this->getIsStatusColumn(), $this->getIsHotColumn()]);
    }

    /**
     * Get the name of the "is status" column.
     *
     * @return string
     */
    public function getIsStatusColumn()
    {
        return defined('static::IS_STATUS') ? static::IS_STATUS : 'is_status';
    }

    /**
     * Get the name of the "is hot" column.
     *
     * @return string
     */
    public function getIsHotColumn()
    {
        return defined('static::IS_HOT') ? static::IS_HOT : 'is_hot';
    }

    /**
     * Get the fully qualified "is status" column.
     *
     * @return string
     */
    public function getQualifiedIsStatusColumn()
    {
        return $this->qualifyColumn($this->getIsStatusColumn());
    }

    /**
     * Get the fully qualified "is hot" column.
     *
     * @return string
     */
    public function getQualifiedIsHotColumn()
    {
        return $this->qualifyColumn($this->getIsHotColumn());
    }

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