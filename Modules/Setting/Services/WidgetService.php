<?php
namespace Modules\Setting\Services;

class WidgetService 
{
    public function parseResultApi($data)
    {
        $results = $data->map(function($items, $key) {
            $method = 'parseResult'.ucfirst(camel_case($key));
            return $this->{$method}($items);
        });
        // $configs = $results->get('widget_config')->get('group');
        // $results->get('widget')->get('group')->transform(function($item) use($configs) {
        //     $itemGroup = collect(data_get($configs, data_get($item, 'value')));
        //     data_set($item, 'disable', $itemGroup->count() === $itemGroup->filter()->count());
        //     return $item;
        // });
        return $results;
    }

    protected function parseResultWidget($items)
    {
        $widgets = $items->map(function($objs, $key) {
            $method = 'parseResult'.ucfirst($key);
            return $this->{$method}($objs);
        });
        $previews = $widgets->get('group')->pluck('html', 'value');
        $widgets->put('preview', $previews);
        $widgets->put('preview_text', $widgets->get('text')->pluck('text', 'key'));
        $widgets->get('group')->transform(function($obj) {
            return array_except($obj, ['html']);
        });
        return $widgets;
    }

    protected function parseResultWidgetConfig($items)
    {
        return $items->map(function($objs, $key) {
            $method = 'parseResultConfig'.ucfirst($key);
            return $this->{$method}($objs);
        });
    }

    protected function parseResultText($items)
    {
        return $items->map(function($obj) {
            return array_merge([
                'key' => $obj->key,
                'header' => trans($obj->language),
            ], json_decode($obj->value, true));
        });
    }

    protected function parseResultGroup($items)
    {
        return $items->map(function($obj) {
            return [
                'value' => $obj->key,
                'text' => trans($obj->language),
                'html' => $obj->value,
                'active' => false,
                'disable' => false,
            ];
        });
    }

    protected function parseResultConfigGroup($items) 
    {
        return $items->keyBy('key')->map(function($obj) {
            return json_decode($obj->value, true);
        });
    }
}