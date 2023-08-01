<?php

namespace Modules\Admin\Repositories\Masters;

use Modules\Core\Entities\Masters\CurrenciesModel;
use Modules\Admin\Grids\Masters\CurrenciesGrid;
use Laka\Core\Repositories\CoreRepository;

class CurrenciesRepository extends CoreRepository
{
    protected $presenterClass = CurrenciesGrid::class;

    protected $modelClass = CurrenciesModel::class;
}
