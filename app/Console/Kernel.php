<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Imovel;
use App\Models\Leitura;
use Ping;
use Mail;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\ConsumirLeitura::class,
        Commands\ConsumirFalha::class,
        Commands\CriarUnidadeAlerta::class,
    ];

    protected function schedule(Schedule $schedule)
    {

        // Cron - Todas as leituras
        // $schedule->command(ConsumirLeitura::class)->daily();
        // $schedule->command(ConsumirFalha::class)->daily()->withoutOverlapping();
        $schedule->command(CriarUnidadeAlerta::class)->hourly();
    }


    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
