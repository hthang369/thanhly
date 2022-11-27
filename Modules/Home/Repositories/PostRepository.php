<?php

namespace Modules\Home\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\PostsModel;
use Laka\Core\Repositories\CoreRepository;

class PostRepository extends CoreRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PostsModel::class;
    }
}
