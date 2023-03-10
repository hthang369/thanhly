<?php


namespace Modules\Setting\Repositories;

use Modules\Admin\Facades\Menus;
use Modules\Setting\Entities\SettingDetailModel;
use Modules\Setting\Entities\SettingModel;
use Modules\Setting\Forms\SettingsForm;
use Modules\Setting\Forms\SettingsHomeForm;
use Modules\Setting\Forms\SettingsMapForm;

/**
 * Class SettingRepository
 * @package Modules\Setting\Repositories
 */
class SettingRepository extends SettingBaseRepository
{
    protected $listFormData = [
        'info' => SettingsForm::class,
        'map' => SettingsMapForm::class,
        'home' => SettingsHomeForm::class,
    ];
    /**
     * @return string
     */
    public function model()
    {
        return SettingModel::class;
    }

    public function formGenerateConfig($id, $route, $action)
    {
        list($options, ) = parent::formGenerate($route, $action);
        data_set($options, 'model', $this->getDataConfig($id));

        return [$options, $this->listFormData[$id]];
    }

    protected function getDataConfig($id)
    {
        return optional($this->getQuery()->where('key', $id)->first()->children, function($item) {
            return $item->pluck('value', 'key')->toArray();
        });
    }

    /**
     * @param $key
     * @param string $before
     * @param string $after
     * @return mixed
     */
    public function getSettingByKey($key, $before = '%', $after = '%')
    {
        return $this->model::where('key', 'like', $before . $key . $after)->get()->toArray();
    }

    public function getAllSetting()
    {
        $data = $this->model->defaultOrder()->get([
            'id',
            'key as title',
            'parent_id',
            'setting_lft',
            'setting_rgt',
        ])->toTree();
        return Menus::getSortableMenus($data);
    }
}
