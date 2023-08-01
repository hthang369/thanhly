<?php

namespace Modules\Core\Entities\Products;

use Modules\Admin\Enums\AttributesGroup;
use Modules\Core\Entities\Brands\BrandsModel;
use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Core\Entities\CoreModel;
use Modules\Core\Entities\Masters\CurrenciesModel;
use Modules\Core\Entities\Masters\PromotionsModel;
use Modules\Core\Entities\Masters\UomsModel;
use Modules\Core\Entities\Masters\VariantsModel;
use Modules\Core\Traits\ActionScopeTrait;
use Modules\Core\Traits\SeoMetaTrait;
use Modules\Setting\Entities\Attributes\AttributesModel;

class ProductsModel extends CoreModel
{
    use ActionScopeTrait, SeoMetaTrait;
    
    protected $table = 'products';

    protected $fillable = [
        'name',
        'sku',
        'price',
        'link',
        'quantity',
        'excerpt',
        'content',
        'author_id',
        'uom_id',
        'brand_id',
        'currency_id',
        'priority',
        'image'
    ];

    protected $slugColumn = [
        'link' => 'name'
    ];

    protected $seoMetaColumn = [
        'ob_title' => 'name'
    ];

    protected $with = [];

    // public function images()
    // {
    //     return $this->hasMany(ProductImagesModel::class, 'product_id');
    // }

    // public function getProductImageAttribute()
    // {
    //     return optional($this->images->first())->product_image;
    // }

    public function categories()
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

    public function currency()
    {
        return $this->belongsTo(CurrenciesModel::class);
    }

    public function brand()
    {
        return $this->belongsTo(BrandsModel::class);
    }

    public function variant()
    {
        return $this->belongsTo(VariantsModel::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(AttributesModel::class, 'product_attributes', 'product_id', 'attribute_id');
    }

    public function getRelationAttributesQuery()
    {
        return $this->attributes()
            ->wherePivotNull('value')
            ->join('attributes as b', 'attributes.id', '=', 'b.parent_id')
            ->leftJoin('attributes as c', 'b.id', '=', 'c.parent_id')
            ->leftJoin('product_attributes as d', function ($join) {
                return $join->where(function($where) {
                    return $where->whereColumn('d.attribute_id', '=', 'c.id')
                        ->orWhereColumn('d.attribute_id', '=', 'b.id');
                })->where('d.product_id', $this->id);
            })
            ->select([
                'c.id',
                'attributes.key as product_key',
                'attributes.language as product_language',
                'b.key as group_key',
                'b.language as group_language',
                'c.key',
                'c.language',
                'd.value'
            ])
            ->whereNotNull('d.value')
            ->orderBy('b.attr_lft')
            ->orderBy('c.attr_lft');
    }

    protected function getRelationProductAttributes()
    {
        return $this->getRelationAttributesQuery()
            ->get()
            ->groupBy('product_key')
            ->transform(function($items) {
                return $items->groupBy('group_key');
            });
    }

    public function getOtherImagesAttribute()
    {
        return $this->getRelationProductAttributes()->get(AttributesGroup::GROUP_IMAGE);
    }

    public function getProductAttributesAttribute()
    {
        return $this->getRelationProductAttributes()->get(AttributesGroup::GROUP_ATTRIBUTE);
    }

    public function getStandoutAttributesAttribute()
    {
        return $this->getRelationAttributesQuery()
            ->where(['b.priority' => 1, 'c.priority' => 1])
            ->get()
            ->groupBy('group_key')
            ->transform(function($items) {
                return $items->pluck('value')->join(' ');
            });
    }
}
