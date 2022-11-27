<?php

namespace Modules\Admin\Repositories;

use Illuminate\Support\Facades\DB;

trait PermissionRoleCriteria
{
    public $role_id;
    protected function getQueryBuilderSub($model)
    {
        $actions = config('permission.actions');

        if (empty($actions)) {
            return [];
        }

        $actionTable = "SELECT 1 as action_id, '{$actions[0]}' as action_name";
        if (isset($actions[1])) {
            unset($actions[0]);
            foreach ($actions as $key => $action) {
                $actionTable .= " UNION SELECT {$key}, '{$action}'";
            }
        }

        $builder = clone $model;
        return $builder->select([DB::raw('IF(section_parent_id = @curID,@r:=@r+1,@r:=1) AS no'),
                    DB::raw('@curID := section_parent_id as parentID'),'sec.*'])
                ->fromSub(
                    $model->select(DB::raw("sections.id AS section_id,
                                                    max(sections.parent_id) AS section_parent_id,
                                                    sections.name AS section_name,
                                                    sections.code AS section_code,
                                                    sections.url AS section_url,
                                                    sections.api AS section_api,
                                                    CONCAT('{', GROUP_CONCAT(IF(role.permission_id IS NULL,
                                                    CONCAT('\"', action_table.action_name, '\"', ':', 0),
                                                    CONCAT('\"', action_table.action_name, '\"', ':', 1))
                                                    ORDER BY action_table.action_id SEPARATOR ','), '}') AS permission"))
                    ->from(DB::raw("({$actionTable}) action_table"))
                    ->crossJoin('sections')
                    ->leftJoin('permissions', DB::raw("CONCAT(action_table.action_name, '_', sections.code)"), '=', 'permissions.name')
                    ->leftJoin(DB::raw("(SELECT * FROM role_has_permissions WHERE role_id = {$this->role_id}) role"), function ($join) {
                        $join->on("role.permission_id", "=", 'permissions.id');
                    })
                    ->groupBy('sections.id', 'sections.name', 'sections.code', 'sections.url', 'sections.api')
                    ->orderBy('sections.parent_id', 'ASC')
                    ->orderBy('sections.id', 'ASC'),
                    'sec'
                )
                ->crossJoin(DB::raw('(SELECT @r:=0,@curID:=0) AS r'));
    }

    public function apply($model)
    {
        return $this->getQueryBuilderSub($model);
    }

}
