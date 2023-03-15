<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Setting\Repositories\WidgetRepository;
use Modules\Setting\Responses\WidgetResponse;
use Modules\Setting\Validators\WidgetValidator;
use Modules\Setting\Forms\WidgetGroupForm;
use Modules\Setting\Forms\WidgetTextForm;
use Laka\Core\Http\Controllers\CoreController;
use Modules\Setting\Services\WidgetService;

class WidgetController extends CoreController
{
    protected $service;

    protected $redirectRoute = [
        'error' => 'setting.index'
    ];

    protected $listViewName = [
        'index'     => 'setting::widgets.widget',
    ];

    protected $permissionActions = [
        'index' => 'public',
        'update' => 'public'
    ];

    public function __construct(WidgetRepository $repository, WidgetValidator $validator, WidgetResponse $response, WidgetService $service)
    {
        parent::__construct($repository, $validator, $response);
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $data = $this->repository->getWidgetList();
        $data = $this->service->parseResultApi($data);
        return $this->renderView($request, $data, __FUNCTION__);
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
