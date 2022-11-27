<?php

namespace Modules\Setting\Http\Controllers;

use Modules\Setting\Repositories\WidgetCriteria;
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

    public function __construct(WidgetRepository $repository, WidgetValidator $validator, WidgetResponse $response, WidgetCriteria $criteria)
    {
        parent::__construct($repository, $validator, $response);
        $this->setDefaultView('setting::');
        $this->setRouteName('widget');
        $this->setPathView([
            'index' => 'setting::widgets.widget',
            'edit'  => 'setting::widget',
            'create' => 'setting::widgets.create',
            // 'show' => 'admin::configs.slide_modal'
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = $this->repository->getWidgetList();

        return $this->renderViewData(compact('data'), __FUNCTION__);
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
