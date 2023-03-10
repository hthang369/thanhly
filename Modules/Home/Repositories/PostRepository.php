<?php

namespace Modules\Home\Repositories;

use Illuminate\Support\Facades\DB;
use Laka\Core\Repositories\CoreRepository;
use Modules\Core\Entities\Posts\PostsModel;
use Modules\Core\Entities\Products\ProductsModel;

class PostRepository extends CoreRepository
{
    protected $modelClass = PostsModel::class;

    public function show($id, $columns = [])
    {
        $viewName = 'index';
        list($info, $listPopular) = $this->findPost($id);
        if (blank($info)) {
            list($info, $listPopular) = $this->findProduct($id);
            $viewName = 'children';
        }
        return ['data' => $info, 'view' => $viewName, 'listPopular' => $listPopular];
    }

    private function findDocument($model, $column, $id, $relationTable, $relationKey, $orderBy, $with = [], $popularColumns = ['*'], $limit = 10)
    {
        $withRelation = array_merge(['category_id'], $with);
        $info = $model->where($column, $id)->with($withRelation)->first();
        if (blank($info)) return [null, null];
        $lstCategories = $info->category_id->pluck('id')->toArray();
        $listPopular = $model->whereKeyNot($info->id)
            ->with($with)
            ->select($popularColumns)
            ->whereExists(function($query) use($lstCategories, $relationTable, $relationKey, $model) {
                $query->selectRaw(1)
                    ->from($relationTable)
                    ->whereIn('category_id', $lstCategories)
                    ->whereColumn($model->getQualifiedKeyName(), '=', "{$relationTable}.{$relationKey}")
                    ->groupBy("{$relationTable}.{$relationKey}")
                    ->havingRaw("COUNT({$relationTable}.{$relationKey}) = 2");
            })
            ->orderBy($orderBy, 'desc')
            ->limit($limit)
            ->get();
            
        return [$info, $listPopular];
    }

    public function findPost($id)
    {
        return $this->findDocument($this->model, 'post_link', $id, 'post_categories', 'post_id', 'post_date', [], [
            'post_title as title',
            'post_link as link',
            'post_image as image'
        ]);
    }

    public function findProduct($id)
    {
        list($info, $popular) = $this->findDocument(resolve(ProductsModel::class), 'link', $id, 'product_categories', 'product_id', 'created_at', ['images:product_id,product_image'], [
            'id', 'name as title', 'link'
        ]);
        $popular->transform(function($item) {
            $item->image = $item->product_image;
            return $item;
        });

        return [$info, $popular];
    }
}
