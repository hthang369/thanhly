<?php

namespace Modules\Admin\Validators\Posts;

use Prettus\Validator\Contracts\ValidatorInterface;
use Laka\Core\Validators\BaseValidator;

/**
 * Class BaseValidator.
 *
 * @package namespace Modules\AssignLeave\Validators;
 */
class PostsValidator extends BaseValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'post_title' => 'required',
            'post_link' => 'nullable|alpha_dash',
            'post_image' => 'nullable|image|mimes:jpg,bmp,png,webp|mimetypes:image/png,image/jpeg,image/bmp,image/webp',
            'category_id' => 'array'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'post_title' => 'required',
            'post_link' => 'nullable|alpha_dash',
            'post_image' => 'nullable|image|mimes:jpg,bmp,png,webp|mimetypes:image/png,image/jpeg,image/bmp,image/webp',
            // 'category_id' => 'category_id'
        ],
    ];

}
