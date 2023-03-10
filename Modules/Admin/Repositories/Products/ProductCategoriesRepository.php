<?php

namespace Modules\Admin\Repositories\Products;

use Modules\Admin\Repositories\AdminBaseRepository;
use Modules\Core\Entities\Products\ProductCategoriesModel;

class ProductCategoriesRepository extends AdminBaseRepository
{
    protected $modelClass = ProductCategoriesModel::class;
}
