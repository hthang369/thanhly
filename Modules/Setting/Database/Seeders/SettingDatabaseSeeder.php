<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Laka\Core\Database\BaseSeeder;
use Laka\Core\Entities\DomainModel;
use Modules\Setting\Entities\SettingModel;

class SettingDatabaseSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
        $this->addData();
        } catch(\Exception $e) {
            dd($e);
        }
    }

    public function addData()
    {
        DB::transaction(function () {
            $data = config('setting.settings');
            SettingModel::truncate();
            $model = resolve(SettingModel::class);
            foreach(DomainModel::pluck('id') as $domain_id) {
                foreach($data as $key => $child) {
                    $parentModel = $model->newInstance(['key' => $key, 'language' => "setting::configs.web_card_{$key}", 'domain_at' => $domain_id]);
                    $parentModel->saveAsRoot();
                    $this->outputInfo($key);
                    foreach($child as $subKey => $item) {
                        $childModel = $model->newInstance(['key' => $subKey, 'language' => "setting::configs.{$subKey}", 'value' => $item, 'domain_at' => $domain_id]);
                        $parentModel->appendNode($childModel);
                        $this->outputInfo($subKey);
                    }
                }
            }
            
        });
        
    }
}
