<?php

namespace Modules\Admin\Forms\Products;

use Laka\Core\Forms\Field;
use Modules\Core\Forms\CoreForm;

class AttributesForm extends CoreForm
{
    protected $groupLangKey = 'products';

    public function buildForm()
    {
        $dataModel = $this->getModel();
        $attrs = optional($dataModel->product_attributes, function($object) {
            return $object->values()->collapse()->pluck('value', 'key');
        });
        foreach($this->getFormOption('model_attrs') as $model) {
            $type = constant('Laka\Core\Forms\Field::'. $model->type) ?? Field::TEXT;
            $keys = array_map('trim', explode(',', $model->value));
            
            $options = collect([
                'label' => trans($model->language),
                'value' => data_get($attrs, $model->key),
                'selected' => data_get($attrs, $model->key),
                'empty_value' => 'Select ...'
            ])->when(str_is($type, Field::DATALIST), function($collect) use($keys) {
                return $collect->put('choices', array_combine($keys, $keys));
            });

            $this->add($model->key, $type, $options->all());
        }
    }
}
