<?php

namespace Modules\Home\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Home\Entities\CounterOnlineModel;
use Laka\Core\Repositories\CoreRepository;

class CounterOnlineRepository extends CoreRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CounterOnlineModel::class;
    }

    public function getTotalCounter($date)
    {
        $result = $this->findByField('date', $date, [DB::raw('COUNT(*) as tong')]);
        return data_get($result, 'tong', 0);
    }

    public function getTotalCounterLessNow($date)
    {
        $result = $this->model->selectRaw('COUNT(*) as tong')->where('date', '<', $date)->first();
        return data_get($result, 'tong', 0);
    }

    public function deleteTimestamp($time)
    {
        return $this->deleteWhere([['date', '<', $time]]);
    }
}
