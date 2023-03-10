<?php

namespace Modules\Core\Entities\Promotions;

use Modules\Core\Entities\CoreModel;

class PromotionsModel extends CoreModel
{
    protected $table = 'promotions';

    protected $fillable = [
        'promotion_name',
        'promotion_value',
        'promotion_type',
    ];
}
