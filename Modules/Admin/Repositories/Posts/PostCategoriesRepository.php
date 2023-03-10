<?php

namespace Modules\Admin\Repositories\Posts;

use Modules\Core\Entities\Posts\PostCategoriesModel;
use Modules\Admin\Repositories\AdminBaseRepository;

class PostCategoriesRepository extends AdminBaseRepository
{
    protected $modelClass = PostCategoriesModel::class;
}
