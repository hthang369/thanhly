<?php

namespace Modules\Admin\Repositories;

use Modules\Admin\Entities\BrandsModel;
use Modules\Admin\Grids\BrandsGrid;
use Laka\Core\Repositories\CoreRepository;

class BrandsRepository extends CoreRepository
{
    protected $presenterClass = BrandsGrid::class;

    protected $modelClass = BrandsModel::class;
}
