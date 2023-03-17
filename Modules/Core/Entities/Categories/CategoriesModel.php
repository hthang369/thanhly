<?php

namespace Modules\Core\Entities\Categories;

use Illuminate\Database\Eloquent\Builder;
use Modules\Admin\Enums\CategoryType;
use Modules\Core\Entities\CoreModel;
use Modules\Core\Entities\News\NewsModel;
use Modules\Core\Entities\Posts\PostsModel;
use Modules\Core\Entities\Products\ProductsModel;
use Modules\Core\Traits\ActionScopeTrait;
use Modules\Core\Traits\NestedSetCategoryTrait;

class CategoriesModel extends CoreModel
{
    use NestedSetCategoryTrait, ActionScopeTrait;

    protected $table = 'categories';

    protected $fillable = [
        'category_name',
        'category_excerpt',
        'category_link',
        'category_image',
        'parent_id',
        'category_lft',
        'category_rgt',
        'ob_title',
        'ob_desception',
        'ob_keyword',
        'category_status',
        'category_type',
        'view_name'
    ];

    protected $slugColumn = [
        'category_link' => 'category_name'
    ];

    protected $seoMetaColumn = [
        'ob_title' => 'category_name'
    ];

    public function getDataByType($type)
    {
        $results = $this->where('category_type', $type)->defaultDepthNestedTree()->get(['id', 'category_name', 'depth']);
        $data = $results->mapToDictionary(function($item, $key) {
            return [data_get($item, 'id') => str_repeat('-- ', data_get($item, 'depth')).data_get($item, 'category_name')];
        })->map(function($item) {
            return head($item);
        });

        return $data->toArray();
    }

    public function posts()
    {
        return $this->belongsToMany(PostsModel::class, 'post_categories', 'category_id', 'post_id');
    }

    public function news()
    {
        return $this->belongsToMany(NewsModel::class, 'post_categories', 'category_id', 'post_id');
    }

    public function products()
    {
        return $this->belongsToMany(ProductsModel::class, 'product_categories', 'category_id', 'product_id'); //->with(['images', 'category_id', 'promotions']);
    }

    public function scopeWithLimitPosts($query, $limit = null, $relations = [])
    {
        return $this->withLimitRelations($query, 'posts', $limit, $relations);
    }

    public function scopeWithLimitProducts($query, $limit = null, $relations = [])
    {
        return $this->withLimitRelations($query, 'products', $limit, $relations);
    }

    public function scopeWithLimitNews($query, $limit = null, $relations = [])
    {
        return $this->withLimitRelations($query, 'news', $limit, $relations);
    }

    protected function withLimitRelations($query, $name, $limit = null, $relations = [])
    {
        return $query->with($name, function($query) use($limit, $relations) {
            return $query->with($relations)->limit($limit);
        });
    }

    public function scopeWithCategoryNews($query)
    {
        return $this->scopeWithCategoryType($query, CategoryType::NEWS);
    }

    public function scopeWithCategoryType($query, $type)
    {
        return $query->where($this->qualifyColumn('category_type'), $type);
    }

    // public function getPostListAttribute()
    // {
    //     return resolve(PostsRepository::class)->getAllDataByCategory($this->id, 8);
    // }
}
