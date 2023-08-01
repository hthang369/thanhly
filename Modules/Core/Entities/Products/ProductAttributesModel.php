<?php

namespace Modules\Core\Entities\Products;

use Laka\Core\Entities\BaseModel;
use Modules\Core\Traits\NestedSetAttributeTrait;

class ProductAttributesModel extends BaseModel
{
    protected $table = 'product_attributes';

    protected $fillable = [
        'product_id',
        'attribute_id',
        'value'
    ];
}
