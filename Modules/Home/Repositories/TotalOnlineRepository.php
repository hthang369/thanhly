<?php

namespace Modules\Home\Repositories;

use Modules\Home\Entities\TotalOnlineModel;
use Laka\Core\Repositories\CoreRepository;

class TotalOnlineRepository extends CoreRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TotalOnlineModel::class;
    }
}
