<?php

namespace Modules\Admin\Repositories\Advertises;

use Illuminate\Support\Facades\DB;
use Laka\Core\Support\FileManagementService;
use Modules\Core\Entities\Advertises\AdvertisesModel;
use Modules\Admin\Forms\Advertises\AdvertisesForm;
use Modules\Admin\Grids\Advertises\AdvertisesGrid;
use Modules\Admin\Repositories\AdminBaseRepository;

class AdvertisesRepository extends AdminBaseRepository
{
    use AdvertisesCriteria;

    protected $presenterClass = AdvertisesGrid::class;

    protected $modelClass = AdvertisesModel::class;

    protected $formClass = AdvertisesForm::class;

    protected $serviceClass = FileManagementService::class;

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
