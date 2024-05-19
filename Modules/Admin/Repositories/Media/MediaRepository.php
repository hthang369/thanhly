<?php

namespace Modules\Admin\Repositories\Media;

use Laka\Core\Support\FileManagementService;
use Modules\Admin\Entities\AdminModel;
use Modules\Admin\Repositories\AdminBaseRepository;

class MediaRepository extends AdminBaseRepository
{
    protected $serviceClass = FileManagementService::class;

    public function model()
    {
        return AdminModel::class;
    }

    public function formGenerate($route, $actionName, $config = [])
    {
        return parent::formGenerate($route, $actionName, ['enctype' => 'multipart/form-data']);
    }

    public function getListFiles()
    {
        return $this->service->getListFileImages();
    }
}
