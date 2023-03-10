<?php

namespace Modules\Setting\Entities;

use Modules\Core\Entities\CoreModel;
use Modules\Setting\Traits\NestedSetSettingTrait;

class SettingModel extends CoreModel
{
    use NestedSetSettingTrait;

    protected $table = 'settings';

    protected $fillable = [
        'key',
        'language',
        'value',
        'parent_id',
        'setting_lft',
        'setting_rgt'
    ];

    protected $dataSortColumns = [
        'id',
        'key as title',
        'parent_id',
        'setting_lft',
        'setting_rgt'
    ];
}
