<?php
namespace Modules\Admin\Support;

class StatusTypeHelper
{
    public function getStatusType($status)
    {
        $variant = 'danger';
        $text = trans('admin::common.deactive');
        if ($status) {
            $variant = 'success';
            $text = trans('admin::common.active');
        }
        return '<span class="badge badge-'.$variant.'">'.$text.'</span>';
    }
}
