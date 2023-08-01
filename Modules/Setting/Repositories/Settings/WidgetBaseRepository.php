<?php

namespace Modules\Setting\Repositories;

abstract class WidgetBaseRepository extends SettingBaseRepository
{
    public function deleteKey($id)
    {
        $settingId = $this->model::getSettingId('widget');
        return $this->model->where('setting_id', $settingId)
                    ->where('key', $id)->delete();
    }
}
