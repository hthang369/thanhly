<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('kbank:crawl_all_data')
            ->withoutOverlapping()
            // ->everyFifteenMinutes()
            ->everyFiveMinutes()
            ->appendOutputTo(storage_path('logs/schedule.log'));

        $schedule->command('kbank:export_all')
            ->withoutOverlapping()
            // ->everyFifteenMinutes()
            ->everyFiveMinutes()
            ->appendOutputTo(storage_path('logs/schedule.log'));

        $schedule->command('kbank:update-report-status')
            ->withoutOverlapping()
            ->monthly()
            ->appendOutputTo(storage_path('logs/schedule.log'));

        $schedule->command('kbank:export_monthly_all')
            ->withoutOverlapping()
            // ->everyFifteenMinutes()
            ->everyFiveMinutes()
            ->appendOutputTo(storage_path('logs/schedule.log'));
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
