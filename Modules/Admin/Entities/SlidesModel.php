<?php

namespace Modules\Admin\Entities;

class SlidesModel extends AdminBaseModel
{
    protected $table = 'advertises';

    protected $fillable = [
        'advertise_name',
        'advertise_link',
        'advertise_image',
        'advertise_type',
        'sequence'
    ];
}
