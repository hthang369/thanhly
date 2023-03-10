<?php
namespace Modules\Core\Enums;

use Laka\Core\Enums\BaseEnum;

class PromotionType extends BaseEnum
{
    const AMOUNT = 'amount';
    const PERCENT = 'percent';
    const ABSOLUTE = 'absolute';
}