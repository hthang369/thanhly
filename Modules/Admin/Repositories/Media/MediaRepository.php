<?php

namespace Modules\Admin\Repositories\Media;

use Laka\Core\Support\FileManagementService;
use Modules\Admin\Entities\AdminModel;
use Modules\Admin\Repositories\AdminBaseRepository;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class MediaRepository extends AdminBaseRepository
{
    protected $serviceClass = FileManagementService::class;

    public function model()
    {
        return AdminModel::class;
    }

    public function formGenerate($route, $actionName, $config = [])
    {
        return parent::formGenerate($route, $actionName, ['enctype' => 'multipart/form-data']);
    }

    public function getListFiles()
    {
        return $this->service->getListFileImages();
    }

    public function getAllDirectories($path = '')
    {
        $dirPath = join(DIRECTORY_SEPARATOR, array_filter(['storage', $path]));
        $iterator = new RecursiveDirectoryIterator(public_path($dirPath), RecursiveDirectoryIterator::SKIP_DOTS);
        $ritit = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);
        $r = array();

        foreach ($ritit as $splFileInfo) {
            if ($splFileInfo->isDir()) {
                $path = [$splFileInfo->getPathname() => []];
                for ($depth = $ritit->getDepth() - 1; $depth >= 0; $depth--) {
                    $path = [$ritit->getSubIterator($depth)->current()->getPathname() => $path];
                }
                $r = array_merge_recursive($r, $path);
            }
        }

        return $this->convertToNewFormat($r);
    }

    private function convertToNewFormat($data)
    {
        $result = [];
        foreach ($data as $fullPath => $children) {
            $key = basename($fullPath);
            $result[] = [
                'key' => $key,
                'label' => $key,
                'children' => $this->convertToNewFormat($children)
            ];
        }
        return $result;
    }
}
