<?php

namespace Modules\Admin\Repositories\Posts;

use Modules\Admin\Repositories\AdminBaseRepository;
use Modules\Core\Entities\Posts\PostAttributesModel;

class PostAttributesRepository extends AdminBaseRepository
{
    protected $modelClass = PostAttributesModel::class;
}
