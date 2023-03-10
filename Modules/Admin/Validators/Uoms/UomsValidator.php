<?php

namespace Modules\Admin\Validators\Uoms;

use Laka\Core\Validators\BaseValidator;
use \Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\Admin\Validators;
 */
class UomsValidator extends BaseValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'uom_name' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'uom_name' => 'required'
        ],
    ];
}
