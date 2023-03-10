<?php

namespace Modules\Admin\Console;

use Illuminate\Console\Command;
use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Core\Entities\Posts\PostsModel;
use Nwidart\Modules\Facades\Module;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MoveFolderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'laka:move-folder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        return;
        $allPost = CategoriesModel::withoutDomain()->get();
        foreach($allPost as $post) {
            $post->ob_title = $post->category_name;
            $post->save();
        }
        return;

        $path = Module::find('admin')->getPath();
        $listFolder = [
            [
                'name' => 'Advertises',
                'namespace' => 'Advertises',
                'folder' => 'Entities'
            ],
            [
                'name' => 'Slides',
                'namespace' => 'Advertises',
                'folder' => 'Entities'
            ],
            [
                'name' => 'Categories',
                'namespace' => 'Categories',
                'folder' => 'Entities'
            ],
            [
                'name' => 'Menus',
                'namespace' => 'Menus',
                'folder' => 'Entities'
            ],
            [
                'name' => 'Posts',
                'namespace' => 'Posts',
                'folder' => 'Entities'
            ],
            [
                'name' => 'PostImages',
                'namespace' => 'Posts',
                'folder' => 'Entities'
            ],
            [
                'name' => 'PostCategories',
                'namespace' => 'Posts',
                'folder' => 'Entities'
            ],
            [
                'name' => 'Pages',
                'namespace' => 'Pages',
                'folder' => 'Entities'
            ],
            [
                'name' => 'News',
                'namespace' => 'News',
                'folder' => 'Entities'
            ],
            [
                'name' => 'Tags',
                'namespace' => 'Tags',
                'folder' => 'Entities'
            ],
            [
                'name' => 'Products',
                'namespace' => 'Products',
                'folder' => 'Entities'
            ],
            [
                'name' => 'ProductImages',
                'namespace' => 'Products',
                'folder' => 'Entities'
            ],
            [
                'name' => 'Roles',
                'namespace' => 'Roles',
                'folder' => 'Entities'
            ],
            [
                'name' => 'PermissionRole',
                'namespace' => 'Roles',
                'folder' => 'Entities'
            ],
            [
                'name' => 'Users',
                'namespace' => 'Users',
                'folder' => 'Entities'
            ],
            [
                'name' => 'Employee',
                'namespace' => 'Users',
                'folder' => 'Entities'
            ],
            [
                'name' => 'Brands',
                'namespace' => 'Brands',
                'folder' => 'Entities'
            ],
            [
                'name' => 'Contacts',
                'namespace' => 'Contacts',
                'folder' => 'Entities'
            ],
            //
            [
                'name' => 'Advertises',
                'namespace' => 'Advertises',
                'folder' => 'Forms'
            ],
            [
                'name' => 'Slides',
                'namespace' => 'Advertises',
                'folder' => 'Forms'
            ],
            [
                'name' => 'Categories',
                'namespace' => 'Categories',
                'folder' => 'Forms'
            ],
            [
                'name' => 'Menus',
                'namespace' => 'Menus',
                'folder' => 'Forms'
            ],
            [
                'name' => 'Posts',
                'namespace' => 'Posts',
                'folder' => 'Forms'
            ],
            [
                'name' => 'Pages',
                'namespace' => 'Pages',
                'folder' => 'Forms'
            ],
            [
                'name' => 'News',
                'namespace' => 'News',
                'folder' => 'Forms'
            ],
            [
                'name' => 'Tags',
                'namespace' => 'Tags',
                'folder' => 'Forms'
            ],
            [
                'name' => 'Products',
                'namespace' => 'Products',
                'folder' => 'Forms'
            ],
            [
                'name' => 'Roles',
                'namespace' => 'Roles',
                'folder' => 'Forms'
            ],
            [
                'name' => 'PermissionRole',
                'namespace' => 'Roles',
                'folder' => 'Forms'
            ],
            [
                'name' => 'Users',
                'namespace' => 'Users',
                'folder' => 'Forms'
            ],
            [
                'name' => 'AccountInfo',
                'namespace' => 'Users',
                'folder' => 'Forms'
            ],
            [
                'name' => 'ChangePassword',
                'namespace' => 'Users',
                'folder' => 'Forms'
            ],
            [
                'name' => 'Brands',
                'namespace' => 'Brands',
                'folder' => 'Forms'
            ],
            [
                'name' => 'Contacts',
                'namespace' => 'Contacts',
                'folder' => 'Forms'
            ],
            //
            [
                'name' => 'Advertises',
                'namespace' => 'Advertises',
                'folder' => 'Grids'
            ],
            [
                'name' => 'Slides',
                'namespace' => 'Advertises',
                'folder' => 'Grids'
            ],
            [
                'name' => 'Categories',
                'namespace' => 'Categories',
                'folder' => 'Grids'
            ],
            [
                'name' => 'Menus',
                'namespace' => 'Menus',
                'folder' => 'Grids'
            ],
            [
                'name' => 'Posts',
                'namespace' => 'Posts',
                'folder' => 'Grids'
            ],
            [
                'name' => 'Pages',
                'namespace' => 'Pages',
                'folder' => 'Grids'
            ],
            [
                'name' => 'News',
                'namespace' => 'News',
                'folder' => 'Grids'
            ],
            [
                'name' => 'Tags',
                'namespace' => 'Tags',
                'folder' => 'Grids'
            ],
            [
                'name' => 'Products',
                'namespace' => 'Products',
                'folder' => 'Grids'
            ],
            [
                'name' => 'Roles',
                'namespace' => 'Roles',
                'folder' => 'Grids'
            ],
            [
                'name' => 'PermissionRole',
                'namespace' => 'Roles',
                'folder' => 'Grids'
            ],
            [
                'name' => 'Users',
                'namespace' => 'Users',
                'folder' => 'Grids'
            ],
            [
                'name' => 'Brands',
                'namespace' => 'Brands',
                'folder' => 'Grids'
            ],
            [
                'name' => 'Contacts',
                'namespace' => 'Contacts',
                'folder' => 'Grids'
            ],
            //
            [
                'name' => 'Advertises',
                'namespace' => 'Advertises',
                'folder' => 'Http/Controllers'
            ],
            [
                'name' => 'Slides',
                'namespace' => 'Advertises',
                'folder' => 'Http/Controllers'
            ],
            [
                'name' => 'Categories',
                'namespace' => 'Categories',
                'folder' => 'Http/Controllers'
            ],
            [
                'name' => 'Menus',
                'namespace' => 'Menus',
                'folder' => 'Http/Controllers'
            ],
            [
                'name' => 'Posts',
                'namespace' => 'Posts',
                'folder' => 'Http/Controllers'
            ],
            [
                'name' => 'Pages',
                'namespace' => 'Pages',
                'folder' => 'Http/Controllers'
            ],
            [
                'name' => 'News',
                'namespace' => 'News',
                'folder' => 'Http/Controllers'
            ],
            [
                'name' => 'Tags',
                'namespace' => 'Tags',
                'folder' => 'Http/Controllers'
            ],
            [
                'name' => 'Products',
                'namespace' => 'Products',
                'folder' => 'Http/Controllers'
            ],
            [
                'name' => 'Roles',
                'namespace' => 'Roles',
                'folder' => 'Http/Controllers'
            ],
            [
                'name' => 'PermissionRole',
                'namespace' => 'Roles',
                'folder' => 'Http/Controllers'
            ],
            [
                'name' => 'Users',
                'namespace' => 'Users',
                'folder' => 'Http/Controllers'
            ],
            [
                'name' => 'Brands',
                'namespace' => 'Brands',
                'folder' => 'Http/Controllers'
            ],
            [
                'name' => 'Contacts',
                'namespace' => 'Contacts',
                'folder' => 'Http/Controllers'
            ],
            //
            [
                'name' => 'Advertises',
                'namespace' => 'Advertises',
                'folder' => 'Repositories'
            ],
            [
                'name' => 'Slides',
                'namespace' => 'Advertises',
                'folder' => 'Repositories'
            ],
            [
                'name' => 'Categories',
                'namespace' => 'Categories',
                'folder' => 'Repositories'
            ],
            [
                'name' => 'Menus',
                'namespace' => 'Menus',
                'folder' => 'Repositories'
            ],
            [
                'name' => 'Posts',
                'namespace' => 'Posts',
                'folder' => 'Repositories'
            ],
            [
                'name' => 'Pages',
                'namespace' => 'Pages',
                'folder' => 'Repositories'
            ],
            [
                'name' => 'News',
                'namespace' => 'News',
                'folder' => 'Repositories'
            ],
            [
                'name' => 'Tags',
                'namespace' => 'Tags',
                'folder' => 'Repositories'
            ],
            [
                'name' => 'Products',
                'namespace' => 'Products',
                'folder' => 'Repositories'
            ],
            [
                'name' => 'Roles',
                'namespace' => 'Roles',
                'folder' => 'Repositories'
            ],
            [
                'name' => 'PermissionRole',
                'namespace' => 'Roles',
                'folder' => 'Repositories'
            ],
            [
                'name' => 'Users',
                'namespace' => 'Users',
                'folder' => 'Repositories'
            ],
            [
                'name' => 'Brands',
                'namespace' => 'Brands',
                'folder' => 'Repositories'
            ],
            [
                'name' => 'Contacts',
                'namespace' => 'Contacts',
                'folder' => 'Repositories'
            ],
            //
            [
                'name' => 'Advertises',
                'namespace' => 'Advertises',
                'folder' => 'Validators'
            ],
            [
                'name' => 'Slides',
                'namespace' => 'Advertises',
                'folder' => 'Validators'
            ],
            [
                'name' => 'Categories',
                'namespace' => 'Categories',
                'folder' => 'Validators'
            ],
            [
                'name' => 'Menus',
                'namespace' => 'Menus',
                'folder' => 'Validators'
            ],
            [
                'name' => 'Posts',
                'namespace' => 'Posts',
                'folder' => 'Validators'
            ],
            [
                'name' => 'Pages',
                'namespace' => 'Pages',
                'folder' => 'Validators'
            ],
            [
                'name' => 'News',
                'namespace' => 'News',
                'folder' => 'Validators'
            ],
            [
                'name' => 'Tags',
                'namespace' => 'Tags',
                'folder' => 'Validators'
            ],
            [
                'name' => 'Products',
                'namespace' => 'Products',
                'folder' => 'Validators'
            ],
            [
                'name' => 'Roles',
                'namespace' => 'Roles',
                'folder' => 'Validators'
            ],
            [
                'name' => 'PermissionRole',
                'namespace' => 'Roles',
                'folder' => 'Validators'
            ],
            [
                'name' => 'Users',
                'namespace' => 'Users',
                'folder' => 'Validators'
            ],
            [
                'name' => 'Brands',
                'namespace' => 'Brands',
                'folder' => 'Validators'
            ],
            [
                'name' => 'Contacts',
                'namespace' => 'Contacts',
                'folder' => 'Validators'
            ],
        ];
        $files = app('files');
        foreach($listFolder as $item) {
            $mainFolder = "{$path}/{$item['folder']}";
            $subFolder = "{$mainFolder}/{$item['namespace']}";
            // $files->ensureDirectoryExists($subFolder);
            $listFileInfo = $files->allFiles($mainFolder);
            foreach($listFileInfo as $fileInfo) {
                if (starts_with($fileInfo->getFileName(), $item['name'])) {
                    // dd($fileInfo->getPathName());
                    $content = join(PHP_EOL, $files->lines($fileInfo->getPathName())->map(function($line) use($item) {
                        if (starts_with($line, 'namespace'))
                            $line = rtrim($line, ';')."\\{$item['namespace']};";
                    
                        return $line;
                    })->toArray());
                    $files->replace($fileInfo->getPathName(), $content);
                    // $files->move($fileInfo->getPathName(), "{$subFolder}/{$fileInfo->getFileName()}");
                }
            }
        }
        // dd(->allFiles($path));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            // ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
