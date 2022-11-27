<?php

namespace Modules\Admin\Validators;

use Laka\Core\Validators\BaseValidator;
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
            'menu_link' => 'nullable|string|alpha_dash',
            'parent_id' => 'nullable|integer'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'menu_name' => 'required',
            'menu_link' => 'nullable|string|alpha_dash',
            'parent_id' => 'nullable|integer'
        ],
        'update-sort' => []
    ];

}
