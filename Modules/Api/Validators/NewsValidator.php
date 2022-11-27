<?php

namespace Modules\Api\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use Laka\Core\Validators\BaseValidator;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\Api\Validators;
 */
class NewsValidator extends BaseValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'age'  => 'required|numeric'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required'
        ],
    ];
}
