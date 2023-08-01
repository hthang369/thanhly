<?php

namespace Modules\Setting\Entities\Attributes;

use Modules\Core\Entities\CoreModel;
use Modules\Setting\Traits\NestedSetAttributeTrait;

class AttributesModel extends CoreModel
{
    use NestedSetAttributeTrait;

    protected $table = 'attributes';

    protected $fillable = [
        'key',
        'language',
        'value',
        'parent_id',
        'attr_lft',
        'attr_rgt',
        'priority',
        'type'
    ];

    protected $fillableColumns = [
        'key',
        'language',
        'parent_id',
        'attr_lft',
        'attr_rgt',
    ];

    protected $dataSortColumns = [
        'id',
        'key',
        'language',
        'parent_id',
        'attr_lft',
        'attr_rgt'
    ];
}
