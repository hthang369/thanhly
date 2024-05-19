<?php

namespace Modules\Core\Responses;

use Illuminate\Http\Request;
use Laka\Core\Facades\Common;
use Laka\Core\Responses\BaseResponse;

class PostResponse extends BaseResponse
{
    public function created(Request $request, $data, $routeName = '', $message = null)
    {
        $routeName = $this->getRouteName();
        return parent::created($request, $data, $routeName, $message);
    }

    public function updated(Request $request, $data, $routeName = '', $message = null)
    {
        $routeName = $this->getRouteName();
        return parent::updated($request, $data, $routeName, $message);
    }

    public function error(Request $request, $error, $routeName = '', $message = null)
    {
        $routeName = $this->getRouteName();
        return parent::error($request, $error, $routeName, $message);
    }

    private function getRouteName()
    {
        $sectionCode = Common::getSectionCode();
        return route("{$sectionCode}.index");
    }
}
