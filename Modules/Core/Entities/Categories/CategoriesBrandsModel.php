<?php

namespace Modules\Core\Entities\Categories;

use Laka\Core\Entities\BaseModel;

class CategoriesBrandsModel extends BaseModel
{
    protected $table = 'categories_brands';

    protected $fillable = [
        'category_id',
        'brand_id'
    ];
}
