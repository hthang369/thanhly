<?php

namespace Modules\Admin\Repositories\Roles;

use Modules\Core\Entities\Roles\RolesModel;
use Modules\Admin\Forms\Roles\RolesForm;
use Modules\Admin\Grids\Roles\RolesGrid;
use Modules\Admin\Repositories\AdminBaseRepository;

class RolesRepository extends AdminBaseRepository
{
    use RolesCriteria;
    protected $presenterClass = RolesGrid::class;

    protected $modelClass = RolesModel::class;

    protected $formClass = RolesForm::class;

    public function newDataGrid()
    {
        $this->scopeQuery(function ($model) {
            return $this->queryCountEmployee($model);
        });
        $data = parent::paginate();
        return [$data, $this->presenterGrid];
    }

    protected function getQuery()
    {
        $this->scopeQuery(function ($model) {
            return $this->queryCountEmployee($model);
        });
        return parent::getQuery();
    }

    protected function queryCountEmployee($model)
    {
        return $model->withCount('users');
    }
}
