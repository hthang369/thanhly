<?php

namespace Modules\Setting\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Setting\Entities\SettingDetailModel;
use Modules\Setting\Entities\SettingModel;
use Modules\Setting\Enums\SettingGroup;

class WidgetRepository extends WidgetBaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SettingModel::class;
    }

    public function getWidgetList()
    {
        $builder = $this->model->newQuery();
        $lft = $this->model->getLftName();
        $domainColumn = $this->model->getDomainColumn();
        $subQuery = $this->model->newQuery()
            ->withoutDomain()
            ->toBase()
            ->select('_n.'.$lft)
            ->from($this->model->getTable().' as _n')
            ->where('_n.key', '=', 'widget')
            ->where("_n.{$domainColumn}", $this->model->getDomainId());

        $value = '('.$subQuery->toSql().')';
        
        $builder->mergeBindings($subQuery);
        
        $result = $builder->whereRaw("{$lft} >= {$value}", [ ], 'and')->get()->toTree();
        return $result->keyBy('key')->map(function($obj) {
            return $obj->children->groupBy(function($item) {
                return str_before($item->key, '_');
            });
        });
    }

    public static function getWidget($name)
    {
        $allSetting = static::getSetting($name);
        return $allSetting->mapToGroups(function ($item, $key) {
            return [str_before($key, '_') => [str_after($key, '_') => $item]];
        })->map(function ($item) {
            return $item->collapse();
        });
    }

    protected function createGroup($attributes)
    {
        DB::transaction(function () use ($attributes) {
            $result = resolve(SettingModel::class)->findOrCreate('widget_config');
            $columns = array_collapse(array_map(function ($item) use ($attributes) {
                return [$item => $attributes[$item]];
            }, $attributes['devices']));
            try {
                $this->model->updateOrCreate([
                    'setting_id' => $result->id,
                    'key' => 'widget_' . $attributes['key']
                ], [
                    'value' => json_encode([
                        'name' => $attributes['name'],
                        'columns' => $columns
                    ])
                ]);
            } catch (\Exception $e) {
            }
        });
    }

    public function create($attributes)
    {
        $settingId = $this->model::getSettingId('widget');
        $data = [
            'setting_id' => $settingId,
            'key' => $attributes['type'].'_'.$attributes['name'],
            'value' => json_encode(['title' => '', 'text' => ''])
        ];
        SettingDetailModel::unguard();
        $result = parent::create($data);
        SettingDetailModel::reguard();
        return $result;
    }

    public function update($attributes, $id)
    {
        $widget_group = data_get($attributes, 'group');
        $data = collect();
        DB::transaction(function () use ($id, $widget_group, &$data, $attributes) {
            $group = static::getDetail(SettingGroup::WIDGET_CONFIG, $widget_group);
            if (!is_array($group))
                $group = json_decode($group, true);
            
            if (!blank($group)) {
                foreach($group as $key => $item) {
                    if (blank($item)) {
                        data_set($group, $key, $id);
                        break;
                    }
                }
            }
            
            $data->push(parent::update([
                $id => json_encode(array_only($attributes, ['title', 'text']))
            ], SettingGroup::WIDGET));
            if (!blank($group)) {
                $data->push(parent::update([
                    $widget_group => json_encode($group)
                ], SettingGroup::WIDGET_CONFIG));
            }
        });
        return $data;
    }

    public function delete($id)
    {
        $results = $this->model->where('value', 'like', "%{$id}%")->get();
        foreach($results as $item) {
            $value = array_except(array_flip(json_decode($item->value)), $id);
            $item->value = json_encode(array_flip($value));
            $item->save();
        }
        return parent::deleteKey($id);
    }

    public function updateSort(array $attributes, $id)
    {
        return $this->updateSortNestedTree($attributes);
    }
}
