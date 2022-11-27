<?php

namespace Modules\Admin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Laka\Core\Validators\BaseValidator;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\AssignLeave\Validators;
 */
class RolesValidator extends BaseValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'advertise_name' => 'required',
            'advertise_link' => 'string|alpha_dash',
            'advertise_image' => 'nullable|image|mimes:jpg,bmp,png|mimetypes:image/png,image/jpeg,image/bmp'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'advertise_name' => 'required',
            'advertise_link' => 'string|alpha_dash',
            'advertise_image' => 'nullable|image|mimes:jpg,bmp,png|mimetypes:image/png,image/jpeg,image/bmp'
        ],
    ];

}
