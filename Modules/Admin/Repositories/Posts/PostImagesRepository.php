<?php

namespace Modules\Admin\Repositories\Posts;

use Modules\Core\Entities\Posts\PostImagesModel;
use Modules\Admin\Repositories\AdminBaseRepository;

class PostImagesRepository extends AdminBaseRepository
{
    protected $modelClass = PostImagesModel::class;
}
