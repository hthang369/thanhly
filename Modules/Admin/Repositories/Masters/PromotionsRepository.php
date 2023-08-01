<?php

namespace Modules\Admin\Repositories\Masters;

use Modules\Core\Entities\Masters\PromotionsModel;
use Modules\Admin\Grids\Masters\PromotionsGrid;
use Laka\Core\Repositories\CoreRepository;
use Modules\Admin\Forms\Masters\PromotionForm;

class PromotionsRepository extends CoreRepository
{
    protected $presenterClass = PromotionsGrid::class;

    protected $modelClass = PromotionsModel::class;

    protected $formClass = PromotionForm::class;
}
