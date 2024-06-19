<?php

namespace Modules\Admin\Http\Controllers\Media;

use DirectoryIterator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Laka\Core\Http\Controllers\CoreController;
use Modules\Admin\Repositories\Media\MediaRepository;
use Modules\Admin\Validators\Media\MediaValidator;
use Laka\Core\Plugins\FileManager\Lfm;
use Laka\Core\Responses\BaseResponse;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RecursiveTreeIterator;
use Symfony\Component\Finder\Finder;

class MediaController extends CoreController
{
    public function __construct(MediaRepository $repository, MediaValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    public function index(Request $request)
    {
        $data = $this->repository->getAllDirectories();

        return view('admin::media.index')->withHelper(resolve(Lfm::class));
    }
    public function show(Request $request, $id = '')
    {
        $data = $this->repository->getListFiles();
        return $this->response->data($request, $data, 'admin::media.show');
    }
}
