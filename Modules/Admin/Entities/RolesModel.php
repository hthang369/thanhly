<?php

namespace Modules\Admin\Entities;

use Laka\Core\Permissions\Role;

class RolesModel extends Role
{
    protected $fillableColumns = ['*'];

    public function getFillableColumns()
    {
        return $this->fillableColumns;
    }
}
