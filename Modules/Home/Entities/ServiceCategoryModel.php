<?php

namespace Modules\Home\Entities;

use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Home\Entities\Scopes\ServiceScope;

class ServiceCategoryModel extends CategoriesModel
{
    protected static function booted()
    {
        static::addGlobalScope(new ServiceScope);
    }


}
