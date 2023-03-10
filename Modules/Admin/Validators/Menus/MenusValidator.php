<?php

namespace Modules\Admin\Validators\Menus;

use Laka\Core\Validators\BaseValidator;
use Modules\Admin\Rules\CustomAlphaDash;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\AssignLeave\Validators;
 */
class MenusValidator extends BaseValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'menu_name' => 'required',
            'menu_link' => ['nullable', 'string'],
            'parent_id' => 'nullable|integer'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'menu_name' => 'required',
            'menu_link' => ['nullable', 'string'],
            'parent_id' => 'nullable|integer'
        ],
        'update-sort' => []
    ];

    protected function configRule(&$rule)
    {
        $rule['menu_link'][] = new CustomAlphaDash;
    }
}
