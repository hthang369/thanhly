<?php

namespace Modules\Core\Entities\Products;

use Laka\Core\Entities\BaseModel;

class ProductImagesModel extends BaseModel
{
    protected $table = 'product_images';

    protected $fillable = [
        'product_id',
        'product_image'
    ];

}
