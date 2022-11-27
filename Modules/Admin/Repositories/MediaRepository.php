<?php

namespace Modules\Admin\Repositories;

use Modules\Admin\Entities\SlidesModel;

class MediaRepository extends AdminBaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SlidesModel::class;
    }

    public function formGenerate($route, $actionName, $config = [])
    {
        return parent::formGenerate($route, $actionName, ['enctype' => 'multipart/form-data']);
    }
}
