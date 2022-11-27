<?php

namespace Modules\Admin\Repositories;

abstract class BasePostsRepository extends AdminBaseRepository
{
    protected $type;

    public function getListOfLink()
    {
        return $this->model->where('post_type', $this->type)->pluck('post_title', 'id');
    }
}
