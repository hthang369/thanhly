<?php

namespace Modules\Api\Repositories;

use Laka\Core\Repositories\CoreRepository;
use Laka\Core\Support\FileManagementService;
use Modules\Api\Entities\NewsModel;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class MediaRepository extends CoreRepository
{
    protected $modelClass = NewsModel::class;
    protected $serviceClass = FileManagementService::class;

    public function treeFolders($type = null)
    {
        $path = config("lfm.folder_categories.{$type}.folder_name");
        if (blank($type)) {
            $path = null;
        }
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

    public function folderContent($folder)
    {
        return array_map(function($file) {
            $newFile = array_merge($file, ['avatar' => sprintf('filetype-%s.png', pathinfo($file['path'], PATHINFO_EXTENSION))]);
            if (str_is(sprintf('%s/*', 'image'), $file['type'])) {
                $newFile = array_merge($file, ['avatar' => url($file['path'])]);
            }
            return $newFile;
        }, $this->service->getAllFiles($folder));
    }

    public function folderCreate($attrs)
    {
        return $this->service->createFolder($attrs['folder'], $attrs['name']);
    }

    public function folderDelete($folder)
    {
        return $this->service->deleteFolder($folder);
    }

    public function fileDelete($folder, $name)
    {
        return $this->service->deleteFileType($folder, $name);
    }

    public function fileUpload($folder, $file)
    {
        // return $this->service->deleteFileType($folder, $name);
    }

    private function convertToNewFormat($data)
    {
        $result = [];
        foreach ($data as $fullPath => $children) {
            $key = basename($fullPath);
            $dirname = array_last(explode(DIRECTORY_SEPARATOR, dirname($fullPath)));
            if ($dirname === 'storage') $dirname = '';
            $result[] = [
                'key' => $key,
                'label' => $key,
                'full_path' => join(DIRECTORY_SEPARATOR, array_filter([$dirname, $key])),
                'children' => $this->convertToNewFormat($children)
            ];
        }
        return $result;
    }
}
