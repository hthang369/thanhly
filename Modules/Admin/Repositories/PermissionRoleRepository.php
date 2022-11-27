<?php

namespace Modules\Admin\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Admin\Grids\PermissionRoleGrid;
use Laka\Core\Permissions\Permission;
use Laka\Core\Permissions\RoleHasPermissions;

class PermissionRoleRepository extends AdminBaseRepository
{
    use PermissionRoleCriteria;

    protected $presenterClass = PermissionRoleGrid::class;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RoleHasPermissions::class;
    }

    protected function getPerPageSize()
    {
        return 100;
    }

    protected function getGridParams()
    {
        $params = parent::getGridParams();
        return array_merge($params, ['paginationSize' => 100]);
    }

    public function update(array $attributes, $id)
    {
        $attributes = array_filter(array_except($attributes, ['_method', '_token', 'q']));
        if (count($attributes) == 0) return;
        $result = Permission::whereIn('name', array_keys($attributes))->pluck('id')->sort();
        return DB::transaction(function () use($id, $result) {
            $this->model->where('role_id', $id)->delete();
            $data = $result->map(function($value) use($id) {
                return [
                    'permission_id' => $value,
                    'role_id' => $id
                ];
            })->toArray();
            return RoleHasPermissions::insert($data);
        });
    }
}
