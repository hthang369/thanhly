<?php

namespace Modules\Admin\Http\Controllers\Users;

use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\Admin\Repositories\Users\UsersRepository;
use Modules\Admin\Validators\Users\UsersValidator;

class UsersController extends CoreController
{
    protected $permissionActions = [
        'accountInfo' => 'edit',
        'updateAccount' => 'edit',
        'updateChangePass' => 'edit'
    ];

    public function __construct(UsersRepository $repository, UsersValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
        // $this->setDefaultView('admin::users');
        // $this->setRouteName('users');
        // $this->setPathView([
        //     'create' => 'admin::users.user_modal',
        //     'show' => 'admin::users.user_modal',
        //     'accountInfo' => 'admin::users.account_info',
        //     'update'    => 'users.update'
        // ]);
    }

    public function accountInfo(Request $request)
    {
        list($modalAccount, $accountData) = $this->repository->accountInfoGenerate('users.account-info', __FUNCTION__);
        $accountInfo = $this->formBuilder->create($accountData, $modalAccount)->renderForm([]);
        list($modalPass, $passData) = $this->repository->changePasswordGenerate('users.account-info', __FUNCTION__);
        $changePassword = $this->formBuilder->create($passData, $modalPass)->renderForm([]);
        return $this->responseView($request, compact('accountInfo', 'changePassword'), $this->getViewName(__FUNCTION__));
    }

    public function updateAccount(Request $request, $id)
    {
        $this->validator($request->all(), ValidatorInterface::RULE_UPDATE);

        $data = $this->repository->update($request->all(), $id);

        return $this->responseAction($request, $data, 'updated');
    }

    public function updateChangePass(Request $request, $id)
    {
        $this->validator($request->all(), 'change_password');

        $data = $this->repository->update($request->all(), $id);

        return $this->responseAction($request, $data, 'updated');
    }
}
