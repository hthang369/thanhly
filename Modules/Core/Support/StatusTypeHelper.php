<?php
namespace Modules\Core\Support;

class StatusTypeHelper
{
    public function getStatusType($status)
    {
        $variant = 'danger';
        $text = trans('core::common.deactive');
        if ($status) {
            $variant = 'success';
            $text = trans('core::common.active');
        }
        return '<span class="badge badge-'.$variant.'">'.$text.'</span>';
    }
}
