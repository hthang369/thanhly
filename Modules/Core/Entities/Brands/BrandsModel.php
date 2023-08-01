<?php

namespace Modules\Core\Entities\Brands;

use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Core\Entities\CoreModel;

class BrandsModel extends CoreModel
{
    protected $table = 'brands';

    protected $fillable = [
        'brand_name',
        'brand_link',
        'brand_image',
    ];

    protected $slugColumn = [
        'brand_link' => 'brand_name'
    ];

    public function categories()
    {
        return $this->belongsToMany(CategoriesModel::class, 'categories_brands', 'brand_id', 'category_id');
    }
}
