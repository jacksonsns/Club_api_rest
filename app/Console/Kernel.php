<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use AppUser;
use AppFatura;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\EnviarFatura::class,
        Commands\VerificarFatura::class
    ];


    protected function schedule(Schedule $schedule)
    {
        $schedule->command('task:EnvioDeFatura')->everyMinute()->daily();
        $schedule->command('task:VerificarFatura')->everyMinute()->daily();
    }


    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
