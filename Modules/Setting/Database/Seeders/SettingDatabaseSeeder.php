<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Setting\Entities\SettingModel;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addData();
    }

    public function addData()
    {
        $data = config('setting.settings');
        SettingModel::truncate();
        $model = resolve(SettingModel::class);
        foreach($data as $key => $child) {
            $parentModel = $model->newInstance(['key' => $key, 'language' => "setting::configs.web_card_{$key}"]);
            $parentModel->saveAsRoot();
            foreach($child as $subKey => $item) {
                $childModel = $model->newInstance(['key' => $subKey, 'language' => "setting::configs.{$subKey}", 'parent_id' => $parentModel->id, 'value' => $item]);
                $parentModel->appendNode($childModel);
            }
        }
    }
}
