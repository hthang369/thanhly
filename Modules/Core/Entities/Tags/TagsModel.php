<?php

namespace Modules\Core\Entities\Tags;

use Modules\Core\Entities\CoreModel;

class TagsModel extends CoreModel
{
    protected $table = 'tags';

    protected $fillable = [
        'name',
        'link'
    ];

    protected $slugColumn = [
        'link' => 'name'
    ];
}
