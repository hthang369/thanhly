<?php

namespace Modules\Setting\Repositories;

use Modules\Setting\Entities\AttributeModel;
use Modules\Setting\Grids\AttributeGrid;
use Laka\Core\Repositories\CoreRepository;
use Modules\Admin\Repositories\AdminBaseRepository;
use Modules\Setting\Forms\AttributeForm;

class AttributeRepository extends AdminBaseRepository
{
    protected $presenterClass = AttributeGrid::class;

    protected $modelClass = AttributeModel::class;

    protected $formClass = AttributeForm::class;

    // public function paginate($limit = null, $columns = [], $method = "paginate")
    // {
    //     $this->model->fixTree();
    //     return parent::paginate($limit, $columns, $method);
    // }

    public function create(array $attributes)
    {
        if (blank($attributes['language']))
            $attributes['language'] = 'admin::attribute.'.$attributes['key'];

        return parent::createNestedTree($attributes);
    }

    public function update(array $attributes, $id)
    {
        if (blank($attributes['language']))
            $attributes['language'] = 'admin::attribute.'.$attributes['key'];

        return parent::updateNestedTree($attributes, $id);
    }
}
