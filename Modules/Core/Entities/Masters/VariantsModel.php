<?php

namespace Modules\Core\Entities\Masters;

use Modules\Core\Entities\CoreModel;
use Modules\Core\Traits\ActionScopeTrait;

class VariantsModel extends CoreModel
{
    use ActionScopeTrait;
    
    protected $table = 'variants';

    protected $fillable = [
        'variant_name',
        'variant_color'
    ];
}
