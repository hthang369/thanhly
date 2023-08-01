<?php

namespace Modules\Setting\Entities;

class SettingDetailModel extends SettingBaseModel
{
    protected $table = 'setting_details';

    protected $fillable = [
        'value'
    ];

    public function setting()
    {
        return $this->belongsTo(SettingModel::class);
    }

    public function getTitleAttribute()
    {
        return data_get(json_decode($this->value, true), 'title');
    }

    public function getTextAttribute()
    {
        return data_get(json_decode($this->value, true), 'text');
    }

    public function getHeaderAttribute()
    {
        return ucfirst(str_replace('_', ' ', str_replace(['text_', 'group_'], ['', ''], $this->key)));
    }
}
