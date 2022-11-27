<?php

namespace Modules\Admin\Validators;

use Laka\Core\Validators\BaseValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\AssignLeave\Validators;
 */
class AdminValidator extends BaseValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        ],
        ValidatorInterface::RULE_UPDATE => [
        ],
    ];

}
