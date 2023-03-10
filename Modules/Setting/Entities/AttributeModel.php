<?php

namespace Modules\Setting\Entities;

use Modules\Core\Entities\CoreModel;
use Modules\Setting\Traits\NestedSetAttributeTrait;

class AttributeModel extends CoreModel
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
        'priority'
    ];

    protected $fillableColumns = [
        'key',
        'language',
        'parent_id',
        'attr_lft',
        'attr_rgt',
    ];
}
