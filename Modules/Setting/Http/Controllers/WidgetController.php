<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Setting\Repositories\WidgetRepository;
use Modules\Setting\Responses\WidgetResponse;
use Modules\Setting\Validators\WidgetValidator;
use Modules\Setting\Forms\WidgetGroupForm;
use Modules\Setting\Forms\WidgetTextForm;
use Laka\Core\Http\Controllers\CoreController;

class WidgetController extends CoreController
{
    protected $redirectRoute = [
        'error' => 'setting.index'
    ];

    protected $listViewName = [
        'index'     => 'setting::widgets.widget',
    ];

    protected $permissionActions = [
        'update' => 'public'
    ];

    public function __construct(WidgetRepository $repository, WidgetValidator $validator, WidgetResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $data = $this->repository->getWidgetList();
        
        return $this->renderView($request, compact('data'), __FUNCTION__);
    }

    public function create($id = null)
    {
        $formBuiderName = WidgetTextForm::class;
        if ($id == 'group')
            $formBuiderName = WidgetGroupForm::class;

        $form = $this->formBuilder->create($formBuiderName, [
            'method' => 'POST',
            'route' => 'widget.store'
        ])->renderForm([]);
        // $data = $this->repository->getWidgetList();
        return $this->renderViewData(compact('form'), __FUNCTION__);
    }
}
