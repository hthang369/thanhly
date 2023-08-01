<?php

namespace Modules\Setting\Validators\Attributes;

use Laka\Core\Validators\BaseValidator;
use \Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\Setting\Validators;
 */
class AttributesValidator extends BaseValidator
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
        'sort' => []
    ];
}
