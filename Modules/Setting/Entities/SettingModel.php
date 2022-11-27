<?php

namespace Modules\Setting\Entities;

use Laka\Core\Entities\BaseModel;
use Modules\Setting\Traits\NestedSetSettingTrait;

class SettingModel extends BaseModel
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
}
