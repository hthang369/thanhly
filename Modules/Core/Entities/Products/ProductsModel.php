<?php

namespace Modules\Core\Entities\Products;

use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Core\Entities\CoreModel;
use Modules\Core\Entities\Promotions\ProductPromotions;
use Modules\Core\Entities\Promotions\PromotionsModel;
use Modules\Core\Entities\Uoms\UomsModel;
use Modules\Core\Traits\ActionScopeTrait;
use Modules\Setting\Entities\AttributeModel;

class ProductsModel extends CoreModel
{
    use ActionScopeTrait;
    
    protected $table = 'products';

    protected $fillable = [
        'name',
        'sku',
        'price',
        'link',
        'quantity',
        'excerpt',
        'content',
        'status',
        'ishot',
        'author_id',
        'uom_id'
    ];

    protected $slugColumn = [
        'link' => 'name'
    ];

    public function images()
    {
        return $this->hasMany(ProductImagesModel::class, 'product_id');
    }

    public function getProductImageAttribute()
    {
        return optional($this->images->first())->product_image;
    }

    public function category_id()
    {
        return $this->belongsToMany(CategoriesModel::class, 'product_categories', 'product_id', 'category_id')->orderBy('category_lft');
    }

    public function promotions()
    {
        return $this->belongsToMany(PromotionsModel::class, 'product_promotions', 'product_id', 'promotion_id');
    }

    public function uom()
    {
        return $this->belongsTo(UomsModel::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(AttributeModel::class, 'product_attributes', 'product_id', 'attribute_id')
            ->select(['attributes.key', 'attributes.language', 'product_attributes.value as pivot_value']);
    }
}
