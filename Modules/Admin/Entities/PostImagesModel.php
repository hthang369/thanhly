<?php

namespace Modules\Admin\Entities;

class PostImagesModel extends AdminBaseModel
{
    protected $table = 'post_images';

    protected $fillable = [
        'post_id',
        'post_image'
    ];

}
