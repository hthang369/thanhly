<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Setting\Repositories\SettingRepository;
use Modules\Setting\Responses\SettingResponse;
use Modules\Setting\Validators\SettingValidator;
use Laka\Core\Http\Controllers\CoreController;

class SettingController extends CoreController
{
    protected $redirectRoute = [
        'error' => 'setting.index'
    ];

    protected $listViewName = [
        'index'     => 'setting::index',
        'create'    => 'kbankapp::customer.generate-url',
        'showSentEmail' => 'kbankapp::customer.sent-email'
    ];

    public function __construct(SettingRepository $repository, SettingValidator $validator, SettingResponse $response)
    {
        parent::__construct($repository, $validator, $response);
        // $this->setPathView([
        //     'edit'  => 'setting::index',
        //     'update' => 'setting.index',
        //     // 'create' => 'admin::configs.slide_modal',
        //     // 'show' => 'admin::configs.slide_modal'
        // ]);
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
        list($configs, $formData) = $this->repository->formGenerateConfig($name, route("setting.$action", $name));

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
        $action = 'edit';
        $actionMap = 'edit';
        $actionHome = 'edit';

        $methodAct = [];
        $methodActMap = [];
        $methodActHome = [];

        if ($id == 'info') {
            $action = 'update';
            $methodAct = ['action' => 'edit'];
        }
        if ($id == 'map') {
            $actionMap = 'update';
            $methodActMap = ['action' => 'edit'];
        }
        if ($id == 'home') {
            $actionHome = 'update';
            $methodActHome = ['action' => 'edit'];
        }

        $form = $this->generateSetting('info', $action, $methodAct);
        $formMap = $this->generateSetting('map', $actionMap, $methodActMap);
        $formHome = $this->generateSetting('home', $actionHome, $methodActHome);

        return $this->renderViewData(compact('form', 'formMap', 'formHome'), __FUNCTION__);
    }
}
