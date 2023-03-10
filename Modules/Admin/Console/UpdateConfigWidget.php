<?php

namespace Modules\Admin\Console;

use Illuminate\Console\Command;
use Modules\Setting\Entities\SettingModel;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateConfigWidget extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'laka:update-widget';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update widget.';

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
        $data = config('setting.settings');

        foreach($data as $key => $item) {
            foreach($item as $subkey => $val) {
                $model = SettingModel::withoutDomain()->where('domain_at', 2)->where('key', $subkey)->first();
                if ($model) {
                    $model->value = $val;
                    $model->save();
                }
            }
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
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
