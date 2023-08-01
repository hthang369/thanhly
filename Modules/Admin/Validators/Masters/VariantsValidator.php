<?php

namespace Modules\Admin\Validators\Masters;

use Laka\Core\Validators\BaseValidator;
use \Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\Admin\Validators;
 */
class VariantsValidator extends BaseValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            // 'name' => 'required',
            // 'age'  => 'required|numeric'
        ],
        ValidatorInterface::RULE_UPDATE => [
            // 'name' => 'required'
        ],
    ];
}
