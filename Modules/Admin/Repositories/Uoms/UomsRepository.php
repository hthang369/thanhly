<?php

namespace Modules\Admin\Repositories\Uoms;

use Laka\Core\Repositories\CoreRepository;
use Modules\Admin\Forms\Uoms\UomsForm;
use Modules\Admin\Grids\Uoms\UomsGrid;
use Modules\Core\Entities\Uoms\UomsModel;

class UomsRepository extends CoreRepository
{
    protected $presenterClass = UomsGrid::class;

    protected $modelClass = UomsModel::class;

    protected $formClass = UomsForm::class;
}
