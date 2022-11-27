<?php

namespace Modules\Home\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Home\Entities\UserOnlineModel;
use Laka\Core\Repositories\CoreRepository;

class UserOnlineRepository extends CoreRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserOnlineModel::class;
    }

    public function deleteTimestamp($time)
    {
        return $this->deleteWhere([['tgtmp', '<', $time]]);
    }

    public function getTotalDataIsIp($ip)
    {
        $result = $this->findByField('ip', $ip, [DB::raw('COUNT(*) as tong')]);
        return data_get($result, 'tong', 0);
    }
}
