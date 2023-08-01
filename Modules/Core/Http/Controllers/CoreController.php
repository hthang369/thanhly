<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Laka\Core\Http\Controllers\CoreController as BaseCoreController;

abstract class CoreController extends BaseCoreController
{
    public function sort(Request $request, $id = null)
    {
        $data = $this->repository->getDataSort($id);
        return $this->renderView($request, $data, __FUNCTION__);
    }

    public function updateSort(Request $request, $id = null)
    {
        $this->validator->setId($id);
        $this->validator($request->all(), 'sort');

        $data = $this->repository->updateSortNestedTree($request->all(), $id);
        
        return $this->responseAction($request, $data, 'updated');
    }
}
