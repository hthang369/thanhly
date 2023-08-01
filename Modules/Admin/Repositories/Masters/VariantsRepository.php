<?php

namespace Modules\Admin\Repositories\Masters;

use Modules\Core\Entities\Masters\VariantsModel;
use Modules\Admin\Grids\Masters\VariantsGrid;
use Laka\Core\Repositories\CoreRepository;
use Modules\Admin\Forms\Masters\VariantsForm;

class VariantsRepository extends CoreRepository
{
    protected $presenterClass = VariantsGrid::class;

    protected $modelClass = VariantsModel::class;

    protected $formClass = VariantsForm::class;
}
