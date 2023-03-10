<?php

namespace Modules\Setting\Validators;

use Laka\Core\Validators\BaseValidator;
use \Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\Setting\Validators;
 */
class AttributeValidator extends BaseValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'key' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'key' => 'required'
        ],
    ];
}
