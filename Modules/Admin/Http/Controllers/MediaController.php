<?php

namespace Modules\Admin\Http\Controllers;

use CKSource\CKFinderBridge\Controller\CKFinderController;
use Modules\Admin\Repositories\MediaCriteria;
use Modules\Admin\Repositories\MediaRepository;
use Modules\Admin\Responses\MediaResponse;
use Modules\Admin\Validators\MediaValidator;
use Laka\Core\Plugins\FileManager\Lfm;

class MediaController extends CKFinderController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin::media.index')->withHelper(resolve(Lfm::class));
    }
}
