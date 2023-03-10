<?php

namespace Modules\Admin\Repositories\Advertises;

use Laka\Core\Support\FileManagementService;
use Modules\Core\Entities\Advertises\SlidesModel;
use Modules\Admin\Forms\Advertises\SlidesForm;
use Modules\Admin\Grids\Advertises\SlidesGrid;
use Modules\Admin\Repositories\AdminBaseRepository;

class SlidesRepository extends AdminBaseRepository
{
    use SlidesCriteria;

    protected $imageColumnName = 'advertise_image';

    protected $presenterClass = SlidesGrid::class;

    protected $modelClass = SlidesModel::class;

    protected $formClass = SlidesForm::class;

    protected $serviceClass = FileManagementService::class;

    public function formGenerate($route, $actionName, $config = [])
    {
        return parent::formGenerate($route, $actionName, ['enctype' => 'multipart/form-data']);
    }

    public function create(array $attributes)
    {
        $attributes['advertise_type'] = 'slide';
        return parent::create($attributes);
    }
}
