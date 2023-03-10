<?php

namespace Modules\Core\Entities\Brands;

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
}
