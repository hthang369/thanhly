<?php
namespace Modules\Core\Traits;

use Illuminate\Database\Eloquent\Model;

trait SeoMetaTrait
{
    public static function bootSeoMetaTrait()
    {
        static::saving(function(Model $model) {
            static::setSeoMeta($model);
        });
    }

    public function initializeSeoMetaTrait()
    {
        $this->mergeFillable([
            $this->getObTitleColumn(), 
            $this->getObKeywordColumn(),
            $this->getObDesceptionColumn()
        ]);
    }

    private static function setSeoMeta($model)
    {
        if (!blank($model->seoMetaColumn) && is_array($model->seoMetaColumn)) {
            $titleColumnName = key($model->seoMetaColumn);
            $columnName = current($model->seoMetaColumn);
            if (blank($model->getAttribute($titleColumnName))) {
                $model->setAttribute($titleColumnName, $model->getAttribute($columnName));
            }
        }
    }

    /**
     * Get the name of the "ob_title" column.
     *
     * @return string
     */
    public function getObTitleColumn()
    {
        return defined('static::OB_TITLE') ? static::OB_TITLE : 'ob_title';
    }

    /**
     * Get the name of the "ob_desception" column.
     *
     * @return string
     */
    public function getObDesceptionColumn()
    {
        return defined('static::OB_DESCEPTION') ? static::OB_DESCEPTION : 'ob_desception';
    }

    /**
     * Get the name of the "ob_keyword" column.
     *
     * @return string
     */
    public function getObKeywordColumn()
    {
        return defined('static::OB_KEYWORD') ? static::OB_KEYWORD : 'ob_keyword';
    }

    /**
     * Get the fully qualified "is status" column.
     *
     * @return string
     */
    public function getQualifiedObTitleColumn()
    {
        return $this->qualifyColumn($this->getObTitleColumn());
    }

    /**
     * Get the fully qualified "is hot" column.
     *
     * @return string
     */
    public function getQualifiedObDesceptionColumn()
    {
        return $this->qualifyColumn($this->getObDesceptionColumn());
    }

    /**
     * Get the fully qualified "is hot" column.
     *
     * @return string
     */
    public function getQualifiedObKeywordColumn()
    {
        return $this->qualifyColumn($this->getObKeywordColumn());
    }
}