<?php

namespace Modules\Core\Entities\Promotions;

use Modules\Core\Entities\CoreModel;

class ProductPromotionsModel extends CoreModel
{
    protected $table = 'product_promotions';

    protected $fillable = [
        'product_id',
        'promotion_id'
    ];
}
