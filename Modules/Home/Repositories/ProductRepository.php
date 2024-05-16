<?php

namespace Modules\Home\Repositories;

use Modules\Core\Entities\Products\ProductsModel;
use Modules\Core\Facades\PromotionFormular;
use Modules\Core\Repositories\HomeCoreRepository;

class ProductRepository extends HomeCoreRepository
{
    protected $modelClass = ProductsModel::class;

    public function showInternal($id, $viewName)
    {
        $info = $this->model->with(['promotions', 'uom', 'currency', 'attributes', 'variant'])->firstWhere('link', '=', $id);
        $info->header_title = $info->name;
        return [
            'view_name' => $viewName ?? 'posts.children',
            'data' => PromotionFormular::calcalulator($info)
        ];
    }

    public function getPopularProducts($id)
    {
        $listInfo = $this->model->with(['promotions', 'currency'])->whereKeyNot($id)
            ->limit(8)->get(['id', 'name as title', 'link', 'currency_id', 'image', 'excerpt']);

        return $listInfo->transform(function($item) {
            $item->link = route('page.show-product', $item->link);
            return $item;
        });
    }
}
