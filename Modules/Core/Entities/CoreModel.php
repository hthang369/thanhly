<?php

namespace Modules\Core\Entities;

use Laka\Core\Entities\BaseModel;
use Laka\Core\Traits\DomainTrait;

abstract class CoreModel extends BaseModel
{
    use DomainTrait;

    protected $slugColumn;
    protected $seoMetaColumn;
    protected $dataSortColumns = [];

    public function listenSaving()
    {
        $this->setAttribute($this->getQualifiedDomainColumn(), $this->getDomainId());
        $this->setSlugColumn();
        $this->setSeoMeta();
    }

    private function setSlugColumn()
    {
        if (!blank($this->slugColumn) && is_array($this->slugColumn)) {
            $slugColumnName = key($this->slugColumn);
            $lstColumns = current($this->slugColumn);
            if (blank($this->getAttribute($slugColumnName))) {
                $slugValue = join('-', array_map(function($column) {
                    return str_slug($this->getAttribute($column));
                }, array_wrap($lstColumns)));
                $this->setAttribute($slugColumnName, $slugValue);
            }
        }
    }

    private function setSeoMeta()
    {
        if (!blank($this->seoMetaColumn) && is_array($this->seoMetaColumn)) {
            $titleColumnName = key($this->seoMetaColumn);
            $columnName = current($this->seoMetaColumn);
            if (blank($this->getAttribute($titleColumnName))) {
                $this->setAttribute($titleColumnName, $this->getAttribute($columnName));
            }
        }
    }

    public function getDataSortColumns()
    {
        if (count($this->dataSortColumns) == 0) {
            return [
                $this->getKeyName(),
                $this->getTitleName(),
                $this->getParentIdName(),
                $this->getLftName(),
                $this->getRgtName()
            ];
        }
        return $this->dataSortColumns;
    }

    public function scopeDefaultDataSortTree($query, $id = null)
    {
        return $query->defaultOrder();
    }
}
