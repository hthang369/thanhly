<?php

namespace Modules\Core\Entities\Products;

use Laka\Core\Entities\BaseModel;

class ProductCategoriesModel extends BaseModel
{
    protected $table = 'product_categories';

    protected $fillable = [
        'product_id',
        'category_id'
    ];

}
