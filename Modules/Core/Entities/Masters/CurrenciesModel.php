<?php

namespace Modules\Core\Entities\Masters;

use Modules\Core\Entities\CoreModel;

class CurrenciesModel extends CoreModel
{
    protected $table = 'currencies';

    protected $fillable = [
        'currency_no',
        'currency_name'
    ];
}
