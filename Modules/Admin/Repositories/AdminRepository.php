<?php

namespace Modules\Admin\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Entities\AdminModel;
use Laka\Core\Facades\Common;

class AdminRepository extends AdminBaseRepository
{
    protected $presenterClass;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminModel::class;
    }

    public function getWatherInfo()
    {
        $address = config('vnnit.wather.api_address');
        $reference = config('vnnit.wather.api_reference.forecasts');
        $optRefer = 'daily';
        $option = config("vnnit.wather.api_options.forecasts.{$optRefer}.5");
        $name = 'TPHCM';
        $locationKey = config("vnnit.wather.list_location.{$name}");
        $params = [
            'language' => 'vi',
            'apikey' => config('vnnit.wather.api_key')
        ];
        $fullUrl = sprintf('%s/%s/%s/%s/%s', $address, $reference, $optRefer, $option, $locationKey);
        $body = Common::callApi('get', $fullUrl, $params);
        $data = [
            'location' => trans("admin::common.wather.location.{$name}"),
            'current' => now('Asia/Ho_Chi_Minh'),
            'list_wather' => []
        ];
        $icon_address = config('vnnit.wather.icon_address');
        dd($body);
        foreach($body->get('DailyForecasts') as $item) {
            $date = Carbon::parse(data_get($item, 'Date'));
            data_set($data, "list_wather.{$date->englishDayOfWeek}", [
                'date' => $date->toDateString(),
                'temperature' => [
                    'min' => round((data_get($item, 'Temperature.Minimum.Value') - 32) / 1.8),
                    'max' => round((data_get($item, 'Temperature.Maximum.Value') - 32) / 1.8),
                ],
                'precipitation' => [
                    'day' => [
                        'icon'  => sprintf('%s/%s.svg', $icon_address, data_get($item, 'Day.Icon')),
                        'icon_phrase' => data_get($item, 'Day.IconPhrase')
                    ],
                    'night' => [
                        'icon'  => sprintf('%s/%s.svg', $icon_address, data_get($item, 'Night.Icon')),
                        'icon_phrase' => data_get($item, 'Night.IconPhrase')
                    ]
                ]
            ]);
        }
        return $data;
    }

    public function getDirectories() 
    {
        $dirs = new \DirectoryIterator(public_path());
        $listDir = [];
        foreach($dirs as $dir) {
            if ($dir->isLink()) {
                array_push($listDir, [
                    'path' => $dir->getPathname(),
                    'linkTarget' => $dir->getLinkTarget()
                ]);
            }
        }
        dd($listDir);
    }
}
