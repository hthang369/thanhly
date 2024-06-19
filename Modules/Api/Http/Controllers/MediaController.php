<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Api\Repositories\MediaRepository;
use Modules\Api\Validators\MediaValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class MediaController extends CoreController
{
    public function __construct(MediaRepository $repository, MediaValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    public function treeFolders(Request $request)
    {
        $result = $this->repository->treeFolders($request->get('type'));
        return $this->response->data($request, $result);
    }

    public function folderContent(Request $request)
    {
        $result = $this->repository->folderContent($request->get('folder'));
        return $this->response->data($request, $result);
    }
    public function folderCreate(Request $request)
    {
        $result = $this->repository->folderCreate($request->only(['folder', 'name']));
        return $this->response->data($request, $result);
    }
    public function folderDelete(Request $request)
    {
        $result = $this->repository->folderDelete($request->get('path'));
        return $this->response->data($request, $result);
    }
    public function fileUpload(Request $request)
    {
        $result = $this->repository->fileUpload($request->get('folder'), $request->file);
        return $this->response->data($request, $result);
    }
    public function fileDelete(Request $request)
    {
        $result = $this->repository->fileDelete($request->get('folder'), $request->file);
        return $this->response->data($request, $result);
    }
}
