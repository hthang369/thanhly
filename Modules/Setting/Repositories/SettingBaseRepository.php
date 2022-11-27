<?php

namespace Modules\Setting\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Setting\Entities\SettingBaseModel;
use Modules\Setting\Entities\SettingDetailModel;
use Modules\Setting\Entities\SettingModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection as SupportCollection;
use Laka\Core\Facades\FileManagement;
use Laka\Core\Repositories\CoreRepository;

/**
 * @property SettingBaseModel model
 */
abstract class SettingBaseRepository extends CoreRepository
{
    protected static $cache = [];

    public function update(array $settings, $id)
    {
        $result = [];
        $updateData = array_diff_key($settings, array_flip(['_method', '_token', 'save_info']));

        foreach ($updateData as $key => $value) {
            $itemValue = $value;
            if ($value instanceof UploadedFile) {
                list($fileInfo) = FileManagement::uploadFileImages([$value]);
                $itemValue = $fileInfo['file_name'];
            }

            $model = $this->updateSettingDetail($this->model::getSettingId($id), $key, $itemValue);
            $result[$model->key] = $model->value;
        }

        return $result;
    }

    protected function updateSettingDetail($settingId, $key, $value)
    {
        try {
            $model = $this->model::where([
                'setting_id' => $settingId,
                'key'        => $key
            ])->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("Setting '$key' of setting_id $settingId not found");
        }

        $model->update([
            'value' => $value
        ]);

        return $model;
    }

    public function all($columns = ['*'])
    {
        $settings = $this->model::where('setting_id', $this->model::getSettingId())->get();

        $result = [];

        foreach ($settings as $setting) {
            $result[$setting->key] = $setting->setAttribute($setting->key, $setting->value)->getAttributeValue($setting->key);
        }

        return $result;
    }

    public static function getSetting($setting)
    {
        if (isset(static::$cache[$setting])) {
            return static::$cache[$setting];
        }

        $settings = SettingDetailModel::whereHas('setting', function ($query) use ($setting) {
            $query->where('name', $setting);
        })
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item['key'] => $item['value']];
            });

        static::$cache[$setting] = $settings;

        return $settings;
    }

    public static function getDetail($setting, $settingDetail, $default = null)
    {
        $settings = static::getSetting($setting);
        // Kiểm tra trường hợp setting bị lưu cache sẽ là object nên không lấy theo array được
        if (is_object($settings) && ($settings instanceof Collection) || ($settings instanceof SupportCollection)) {
            return $settings->get($settingDetail, $default);
        } else {
            return $settings[$setting][$settingDetail] ?? $default;
        }

//        $detail = SettingDetailModel::whereHas('setting', function ($query) use ($setting) {
//            $query->where('name', $setting);
//        })
//            ->where('key', $settingDetail)
//            ->first();
//
//        return !is_null($detail) ? $detail->value : $default;
    }

    public function allSettings()
    {
        $all = $this->model->get()->toPluck('value', 'key');
        return collect($this->parseDataSetting($all));
    }

    private function parseDataSetting($data)
    {
        return array_map(function($item) {
            if (is_string($item)) {
                $value = json_decode($item, true);
                if (json_last_error() != JSON_ERROR_NONE) {
                    $value = $item;
                }
                return $value;
            } else {
                return $this->parseDataSetting($item);
            }
        }, $data);
    }

    public function getSettingByName($name)
    {
        $detail = SettingDetailModel::whereHas('setting', function ($query) use ($name) {
            $query->where('name', $name);
        })->get();
        return $detail;
    }
}
