<?php

namespace Modules\Admin\Http\Controllers\Media;

use Illuminate\Http\Request;
use Laka\Core\Http\Controllers\CoreController;
use Modules\Admin\Repositories\Media\MediaRepository;
use Modules\Admin\Validators\Media\MediaValidator;
use Laka\Core\Plugins\FileManager\Lfm;
use Laka\Core\Responses\BaseResponse;

class MediaController extends CoreController
{
    public function __construct(MediaRepository $repository, MediaValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    public function index(Request $request)
    {
        return view('admin::media.index')->withHelper(resolve(Lfm::class));
    }
    public function show(Request $request, $id = '')
    {
        $data = $this->repository->getListFiles();
        return $this->response->data($request, $data, 'admin::media.show');
    }
}
