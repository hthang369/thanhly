<?php

namespace Modules\Admin\Validators;

use Laka\Core\Validators\BaseValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\AssignLeave\Validators;
 */
class CategoriesValidator extends BaseValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'category_name' => 'required',
            'category_link' => 'nullable|string|alpha_dash',
            'parent_id' => 'nullable|integer'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'category_name' => 'required',
            'category_link' => 'nullable|string|alpha_dash',
            'parent_id' => 'integer'
        ],
    ];

}
