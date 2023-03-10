<?php

namespace Modules\Core\Entities\Advertises;

use Modules\Core\Entities\CoreModel;

class AdvertisesModel extends CoreModel
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
