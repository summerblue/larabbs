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
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        if (app()->environment('production')) {
            $schedule->command('backup:run')->cron('0 */4 * * * *');
            $schedule->command('backup:monitor')->dailyAt('03:00');
            $schedule->command('backup:clean')->dailyAt('03:10');
        }

        // 一小时执行一次『活跃用户』数据生成的命令
        $schedule->command('larabbs:calculate-active-user')->hourly();

        // 每日零时执行一次
        $schedule->command('larabbs:calculate-active-user')->dailyAt('00:00');
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
