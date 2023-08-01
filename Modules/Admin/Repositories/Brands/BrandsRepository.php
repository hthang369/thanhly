<?php

namespace Modules\Admin\Repositories\Brands;

use Laka\Core\Support\FileManagementService;
use Modules\Admin\Forms\Brands\BrandsForm;
use Modules\Admin\Grids\Brands\BrandsGrid;
use Modules\Admin\Repositories\AdminBaseRepository;
use Modules\Core\Entities\Brands\BrandsModel;

class BrandsRepository extends AdminBaseRepository
{
    protected $presenterClass = BrandsGrid::class;

    protected $modelClass = BrandsModel::class;

    protected $formClass = BrandsForm::class;

    public function service()
    {
        $serviceClass = resolve(FileManagementService::class);
        $serviceClass->setSubDirectories('brands');
        return $serviceClass;
    }
}
