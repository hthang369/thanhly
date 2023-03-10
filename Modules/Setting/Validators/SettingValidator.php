<?php

namespace Modules\Setting\Validators;

use Laka\Core\Validators\BaseValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class SettingValidator extends BaseValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'web_phone' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'info' => [
                'web_name' => 'required',
                'web_phone' => 'required',
                'web_address' => 'required',
                'web_email' => 'required|email',
                'ob_title' => 'nullable',
                'ob_description' => 'nullable',
                'ob_keyword' => 'nullable',
            ],
            'home' => [
                'web_favicon' => 'required',
                'web_logo' => 'required',
                'web_banner' => 'required',
            ],
            'map' => [
                'web_map' => 'required'
            ]
        ],
        'sort' => []
    ];

    public function getRules($action = null)
    {
        if ($action == 'sort') return [];
        $rules = data_get($this->rules, "{$action}.{$this->id}");
        $rule = $this->parserValidationRules($rules, $this->id);
        return $rule;
    }
}
