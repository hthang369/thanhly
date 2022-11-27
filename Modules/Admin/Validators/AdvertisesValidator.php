<?php

namespace Modules\Admin\Validators;

use Laka\Core\Validators\BaseValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\AssignLeave\Validators;
 */
class AdvertisesValidator extends BaseValidator
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
