<?php

namespace Modules\Core\Entities\Uoms;

use Modules\Core\Entities\CoreModel;

class UomsModel extends CoreModel
{
    protected $table = 'uoms';

    protected $fillable = [
        'uom_name',
        'uom_factor'
    ];
}
