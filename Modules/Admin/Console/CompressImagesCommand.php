<?php

namespace Modules\Admin\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Tinify\Source;
use Tinify\Tinify;

class CompressImagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'vnnit:compress-image';

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
        Tinify::setKey('jxC1sn1JykDtWGJzNsKbSZzbzRKtkZsP');
        // dd($source);
        $allFiles = File::files(storage_path('app/public/images'));
        $allFilesCompress = File::files(storage_path('app/public/compress_images'));
        $listImgCompress = array_map(function($item) {
            return $item->getFilename();
        }, $allFilesCompress);
        foreach($allFiles as $file) {
            if (!in_array($file->getFilename(), $listImgCompress) && $file->getExtension() != 'ico') {
                $source = Source::fromFile($file->getPathname());
                $source->toFile(storage_path('app/public/compress_images/'.$file->getFilename())); 
            }   
            // 
            // dd($file->getPathname());
        }
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
            // ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
