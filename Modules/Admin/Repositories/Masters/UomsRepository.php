<?php

namespace Modules\Admin\Repositories\Masters;

use Laka\Core\Repositories\CoreRepository;
use Modules\Admin\Forms\Masters\UomsForm;
use Modules\Admin\Grids\Masters\UomsGrid;
use Modules\Core\Entities\Masters\UomsModel;

class UomsRepository extends CoreRepository
{
    protected $presenterClass = UomsGrid::class;

    protected $modelClass = UomsModel::class;

    protected $formClass = UomsForm::class;
}
