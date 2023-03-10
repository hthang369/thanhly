<?php

namespace Modules\Core\Entities\Posts;

use Laka\Core\Entities\BaseModel;

class PostImagesModel extends BaseModel
{
    protected $table = 'post_images';

    protected $fillable = [
        'post_id',
        'post_image'
    ];

}
