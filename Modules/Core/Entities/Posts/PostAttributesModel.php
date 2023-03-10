<?php

namespace Modules\Core\Entities\Posts;

use Laka\Core\Entities\BaseModel;

class PostAttributesModel extends BaseModel
{
    protected $table = 'post_attributes';

    protected $fillable = [
        'post_id',
        'attribute_id',
        'value'
    ];

}
