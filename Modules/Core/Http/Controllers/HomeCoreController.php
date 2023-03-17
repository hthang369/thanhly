<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Laka\Core\Http\Controllers\CoreController as BaseCoreController;
use Modules\Core\Traits\HomeCoreTrait;

abstract class HomeCoreController extends BaseCoreController
{
    use HomeCoreTrait;

    protected $permissionActions = [
        'show' => 'public',
    ];

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $base = $this->repository->show($id);
        $this->sharePageTitle(data_get($base, 'data.ob_title'));
        
        $viewName = $base['view_name'];
        if (blank($viewName)) $viewName = 'show';

        return $this->response->data($request, ['data' => $base['data']], module_view_name($viewName));
    }
}
