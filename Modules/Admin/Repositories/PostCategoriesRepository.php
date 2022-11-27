<?php

namespace Modules\Admin\Repositories;

use Modules\Admin\Entities\PostCategoriesModel;

class PostCategoriesRepository extends AdminBaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PostCategoriesModel::class;
    }

}
