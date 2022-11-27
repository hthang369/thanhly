<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Api\Repositories\ContactsCriteria;
use Modules\Api\Repositories\ContactsRepository;
use Modules\Api\Responses\ContactsResponse;
use Modules\Api\Validators\ContactsValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Laka\Core\Http\Controllers\BaseController;

class ContactsController extends BaseController
{
    protected $actionPermissionList = [
        'sendMail' => 'public'
    ];

    public function __construct(ContactsRepository $repository, ContactsValidator $validator, ContactsResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    public function sendMail(Request $request)
    {
        try {
            $this->validator($request->all(), ValidatorInterface::RULE_CREATE);

            $data = $this->repository->sendMail(request()->all());

            return $this->response->data($data);
        } catch (\Exception $e) {
            return $this->responseErrorAction($request, $e);
        }
    }
}
