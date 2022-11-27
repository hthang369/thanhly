<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Common\Entities\Menus\Menus;

class LakaInitDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kbank-tool:init {--reset}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        if ($this->option('reset')) {
            $this->info('Reset database ...');

            $this->info('Reset database: Done!');
        }
        $this->info('Reset menu ...');
        Menus::truncate();
        Artisan::call('db:seed', ['--class' => 'MenuSeeder']);
        $this->info('Reset menu: Done!');
        $this->info('Done!');
        return 0;
    }
}
