<?php

namespace Modules\Admin\Repositories;

use Modules\Admin\Entities\ProductsModel;
use Modules\Admin\Grids\ProductsGrid;
use Laka\Core\Repositories\CoreRepository;
use Modules\Admin\Forms\ProductsForm;

class ProductsRepository extends CoreRepository
{
    protected $presenterClass = ProductsGrid::class;

    protected $modelClass = ProductsModel::class;

    protected $formClass = ProductsForm::class;
}
