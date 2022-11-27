<?php

namespace Modules\Admin\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\AdvertisesModel;
use Modules\Admin\Forms\AdvertisesForm;
use Modules\Admin\Grids\AdvertisesGrid;
use Laka\Core\Support\FileManagementService;

class AdvertisesRepository extends AdminBaseRepository
{
    use AdvertisesCriteria;

    protected $presenterClass = AdvertisesGrid::class;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdvertisesModel::class;
    }

    /**
     * Specify Form class name
     *
     * @return string
     */
    public function form()
    {
        return AdvertisesForm::class;
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
        $dataImageNew = $this->uploadFile($attributes, 'advertise_image');
        if ($dataImageNew)
            $attributes['advertise_image'] = $dataImageNew;
        $attributes['advertise_type'] = 'advertise';
        return parent::create($attributes);
    }

    public function update(array $attributes, $id)
    {
        return DB::transaction(function () use($attributes, $id) {
            $data = $this->find($id, ['advertise_image']);
            $dataImageNew = $this->uploadFile($attributes, 'advertise_image', null, false);
            if ($dataImageNew)
                $attributes['advertise_image'] = $dataImageNew;
            $base = parent::update($attributes, $id);
            $this->deleteFile($data['advertise_image']);
            return $base;
        });
    }
}
