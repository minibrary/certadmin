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
        Commands\ReminderMail::class,
        Commands\X509Reload::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
	      $schedule->command('reminder:mail --queue=default --daysleft=60')->dailyAt('06:00')->appendOutputTo('storage/logs/reminder-mail.log')->withoutOverlapping();
        $schedule->command('reminder:mail --queue=default --daysleft=30')->dailyAt('06:00')->appendOutputTo('storage/logs/reminder-mail.log')->withoutOverlapping();
        $schedule->command('reminder:mail --queue=default --daysleft=14')->dailyAt('06:00')->appendOutputTo('storage/logs/reminder-mail.log')->withoutOverlapping();
        $schedule->command('reminder:mail --queue=default --daysleft=7')->dailyAt('06:00')->appendOutputTo('storage/logs/reminder-mail.log')->withoutOverlapping();
        $schedule->command('x509:reload')->hourlyAt(15)->appendOutputTo('storage/logs/x509-reload.log')->withoutOverlapping();
    }
     /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
