<?php

namespace Modules\Admin\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\SlidesModel;
use Modules\Admin\Forms\SlidesForm;
use Modules\Admin\Grids\SlidesGrid;
use Laka\Core\Support\FileManagementService;

class SlidesRepository extends AdminBaseRepository
{
    use SlidesCriteria;

    protected $imageColumnName = 'advertise_image';

    protected $presenterClass = SlidesGrid::class;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SlidesModel::class;
    }

    /**
     * Specify Form class name
     *
     * @return string
     */
    public function form()
    {
        return SlidesForm::class;
    }

    /**
     * Specify Service class name
     *
     * @return string
     */
    public function service()
    {
        return FileManagementService::class;
    }

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
