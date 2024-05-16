<?php

namespace Modules\Home\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Core\Entities\Posts\PostsModel;
use Modules\Core\Entities\Products\ProductsModel;
use Modules\Core\Repositories\HomeCoreRepository;

class PostRepository extends HomeCoreRepository
{
    protected $modelClass = PostsModel::class;

    public function showInternal($id, $viewName)
    {
        list($info, $listPopular) = $this->findPost($id);
        $info->header_title = $info->post_title;
        return ['data' => $info, 'view' => $viewName, 'listPopular' => $listPopular];
    }

    public function findPost($id)
    {
        return $this->findDocument($this->model, 'post_link', $id, 'post_categories', 'post_id', 'post_date', [], [
            'post_title as title',
            'post_link as link',
            'post_image as image',
            'post_excerpt as excerpt'
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
