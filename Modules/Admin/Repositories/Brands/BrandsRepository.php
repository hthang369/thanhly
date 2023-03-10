<?php

namespace Modules\Admin\Repositories\Brands;

use Laka\Core\Repositories\CoreRepository;
use Modules\Admin\Forms\Brands\BrandsForm;
use Modules\Admin\Grids\Brands\BrandsGrid;
use Modules\Core\Entities\Brands\BrandsModel;

class BrandsRepository extends CoreRepository
{
    protected $presenterClass = BrandsGrid::class;

    protected $modelClass = BrandsModel::class;

    protected $formClass = BrandsForm::class;
}
