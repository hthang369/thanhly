<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Setting\Repositories\SettingRepository;
use Modules\Setting\Responses\SettingResponse;
use Modules\Setting\Validators\SettingValidator;

class SettingController extends CoreController
{
    protected $redirectRoute = [
        'error' => 'setting.index'
    ];

    protected $listViewName = [
        'index'     => 'setting::setting.index',
        'edit'     => 'setting::setting.setting_modal',
        'sort'     => 'setting::setting.sort',
        'create'    => 'kbankapp::customer.generate-url',
        'showSentEmail' => 'kbankapp::customer.sent-email'
    ];

    protected $permissionActions = [
        'update' => 'public'
    ];

    public function __construct(SettingRepository $repository, SettingValidator $validator, SettingResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $form = $this->generateSetting('info');
        $formMap = $this->generateSetting('map');
        $formHome = $this->generateSetting('home');

        return $this->responseView($request, compact('form', 'formMap', 'formHome'), $this->getViewName(__FUNCTION__), $this->getMessageResponse(__FUNCTION__));
    }

    private function generateSetting($name, $action = 'edit', $dataBidding = [])
    {
        list($configs, $formData) = $this->repository->formGenerateConfig($name, ["setting.$action", $name], $action);
        
        $configs['method'] = $action == 'edit' ? 'GET' : 'PUT';

        return $this->formBuilder->create($formData, $configs, $dataBidding);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $action = 'update';
        $methodAct = ['action' => 'edit'];

        $formField = $this->generateSetting($id, $action, $methodAct);

        $modal = $formField->getFormOptions();
        $form = $formField->renderForm([], false, true, false);
    
        return $this->renderView($request, compact('modal', 'form'), __FUNCTION__);
    }
}
