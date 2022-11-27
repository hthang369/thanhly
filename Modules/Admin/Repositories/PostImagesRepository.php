<?php

namespace Modules\Admin\Repositories;

use Modules\Admin\Entities\PostImagesModel;

class PostImagesRepository extends AdminBaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PostImagesModel::class;
    }
}
