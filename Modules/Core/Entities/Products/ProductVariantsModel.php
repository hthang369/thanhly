<?php

namespace Modules\Core\Entities\Products;

use Laka\Core\Entities\BaseModel;

class ProductVariantsModel extends BaseModel
{
    protected $table = 'product_variants';

    protected $fillable = [
        'product_id',
        'variant_id',
        'quantity'
    ];
}
