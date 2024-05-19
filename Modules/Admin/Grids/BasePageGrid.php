<?php

namespace Modules\Admin\Grids;

use Modules\Core\Grids\BaseGrid;

class BasePageGrid extends BaseGrid
{
    protected $showModals = [
        'create' => false,
        'edit' => false,
    ];
}
