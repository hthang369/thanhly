<?php

namespace Modules\Admin\Validators\Pages;

use Prettus\Validator\Contracts\ValidatorInterface;
use Laka\Core\Validators\BaseValidator;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\AssignLeave\Validators;
 */
class PagesValidator extends BaseValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'post_title' => 'required',
            'post_link' => 'nullable|string|alpha_dash',
            'post_image' => 'nullable|image|mimes:jpg,bmp,png|mimetypes:image/png,image/jpeg,image/bmp'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'post_title' => 'required',
            'post_link' => 'nullable|string|alpha_dash',
            'post_image' => 'nullable|image|mimes:jpg,bmp,png|mimetypes:image/png,image/jpeg,image/bmp'
        ],
    ];

}
