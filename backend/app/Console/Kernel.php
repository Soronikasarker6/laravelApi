<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
// use App\Console\Commands\RunMigrations;
class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\RunMigrations::class,
    ];
 
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        $schedule->command('app:task')->everyMinute()->timezone('America/New_York')->withoutOverlapping()->runInBackground();

        // $schedule->call(function(){
        //     info("called every minutes");
        // })->everyMinute();
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {

        $this->load(__DIR__.'/Commands');
     

        require base_path('routes/console.php');
    }
}
