<?php

namespace Modules\Core\Entities\Products;

use Laka\Core\Entities\BaseModel;

class ProductPromotionsModel extends BaseModel
{
    protected $table = 'product_promotions';

    protected $fillable = [
        'product_id',
        'promotion_id'
    ];

}
