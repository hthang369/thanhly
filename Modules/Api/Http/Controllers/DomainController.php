<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Api\Repositories\DomainRepository;
use Modules\Api\Validators\DomainValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class DomainController extends CoreController
{
    public function __construct(DomainRepository $repository, DomainValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    public function search(Request $request)
    {
        $result = $this->repository->search($request->get('key'));
        return $this->response->data($request, $result);
    }
}
