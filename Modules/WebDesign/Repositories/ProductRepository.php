<?php

namespace Modules\WebDesign\Repositories;

use Modules\WebDesign\Entities\ProductModel;
use Modules\WebDesign\Grids\ProductControllerGrid;
use Modules\Core\Repositories\HomeCoreRepository;

class ProductRepository extends HomeCoreRepository
{
    protected $modelClass = ProductModel::class;

    public function showProduct($id, $viewName)
    {
        
    }
}
