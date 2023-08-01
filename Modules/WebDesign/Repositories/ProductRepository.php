<?php

namespace Modules\WebDesign\Repositories;

use Modules\Core\Entities\Products\ProductsModel;
use Modules\Core\Repositories\HomeCoreRepository;

class ProductRepository extends HomeCoreRepository
{
    protected $modelClass = ProductsModel::class;

    public function showProduct($id, $viewName)
    {
        
    }

    public function findProduct($id)
    {
        return $this->model->where('link', $id)->first();
    }

    public function showInternal($id, $viewName)
    {
        return [
            'view_name' => $viewName ?? 'show_product',
            'data' => $this->model->where('link', $id)->first()
        ];
    }
}
