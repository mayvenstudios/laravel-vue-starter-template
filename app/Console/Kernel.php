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
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

//        /**
//         * This creates a backup of the production DB on s3.
//         */
//        $schedule->command('backup:run --only-db')
//            ->dailyAt('23:21')
//            ->thenPing('http://beats.envoyer.io/heartbeat/Ris6PH8ssc8hlPs');

    }
}
