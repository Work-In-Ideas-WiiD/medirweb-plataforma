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
        $schedule->command(ConsumirLeitura::class)->daily();
        $schedule->command(ConsumirFalha::class)->daily()->withoutOverlapping();
        $schedule->command(CriarUnidadeAlerta::class)->everySixHours();

        /*
        $schedule->call(function () {

            $imovel = Imovel::get();

            foreach($imovel as $imo){

                if(sprintf("%02s", $imo->IMO_FATURACICLO) == date("d")){
                    $codigoHTTP = Ping::check($imo->IMO_IP);

                    if($codigoHTTP == 200){

                        // Requisiçao leituras de todas as prumadas
                        $curl = curl_init();

                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($curl, CURLOPT_URL, 'http://'.$imo->IMO_IP.'/cron/leiturastodasprumadas/');
                        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 15);
                        curl_setopt($curl, CURLOPT_TIMEOUT, 15);

                        $resp = curl_exec($curl);
                        curl_close($curl);
                        // fim

                        echo $resp;
                        echo ' - '.$imo->IMO_NOME.'<br><hr>';
                    }else{

                        $text = "por este motivo não foi possível realizar as leituras automáticas.";

                        // ENVIAR EMAIL informando a falha de comunicação.
                        Mail::send('email.falhaCronAllLei', ['imovel'=> $imo->IMO_NOME, 'ip' => $imo->IMO_IP, 'codigoHTTP' => $codigoHTTP, 'text' => $text], function($message) use ($imo) {
                            $message->from('suporte@medirweb.com.br', 'MedirWeb - Plataforma individualizadora');
                            $message->to('suporte@medirweb.com.br');
                            $message->cc('contato@wi-id.com');
                            $message->cc('i.v.nascimento.ti@gmail.com');
                            $message->subject('Requisição Leituras de Todas as Prumadas');
                        });
                        // fim - enviar email

                        echo 'error: '.$imo->IMO_NOME.'<br><hr>';
                    }

                }
            }

        })->daily();


        // Cron - Todas as leituras falhadas
        $schedule->call(function () {

            $imovel = Imovel::get();

            foreach($imovel as $imo){

                if(sprintf("%02s", $imo->IMO_FATURACICLO) == date("d")){
                    $codigoHTTP = Ping::check($imo->IMO_IP);

                    if($codigoHTTP == 200){

                        // Requisiçao leituras falhadas
                        $curl = curl_init();

                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($curl, CURLOPT_URL, 'http://'.$imo->IMO_IP.'/cron/leiturasfalhas/');
                        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 15);
                        curl_setopt($curl, CURLOPT_TIMEOUT, 15);

                        $resp = curl_exec($curl);
                        curl_close($curl);
                        // fim

                        echo $resp;
                        echo ' - '.$imo->IMO_NOME.'<br><hr>';
                    }else{

                        $text = "por este motivo não foi possível realizar as leituras com falhas.";

                        // ENVIAR EMAIL informando a falha de comunicação.
                        Mail::send('email.falhaCronAllLei', ['imovel'=> $imo->IMO_NOME, 'ip' => $imo->IMO_IP, 'codigoHTTP' => $codigoHTTP, 'text' => $text], function($message) use ($imo) {
                            $message->from('suporte@medirweb.com.br', 'MedirWeb - Plataforma individualizadora');
                            $message->to('suporte@medirweb.com.br');
                            $message->cc('contato@wi-id.com');
                            $message->cc('i.v.nascimento.ti@gmail.com');
                            $message->subject('Requisição Leituras Falhadas');
                        });
                        // fim - enviar email

                        echo 'error: '.$imo->IMO_NOME.'<br><hr>';
                    }

                }
            }

        })->twiceDaily(1,2,3,4,5);


        // Cron - Enviar Leitura Plataforma
        $schedule->call(function () {

            $imovel = Imovel::get();

            foreach($imovel as $imo){

                if(sprintf("%02s", $imo->IMO_FATURACICLO) == date("d")){
                    $codigoHTTP = Ping::check($imo->IMO_IP);

                    if($codigoHTTP == 200){

                        // Enviar Todas as Leitura para Plataforma
                        $curl = curl_init();

                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($curl, CURLOPT_URL, 'http://'.$imo->IMO_IP.'/cron/enviarleituras/');
                        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 15);
                        curl_setopt($curl, CURLOPT_TIMEOUT, 15);

                        $resp = curl_exec($curl);
                        curl_close($curl);
                        // fim

                        echo $resp;
                        echo ' - '.$imo->IMO_NOME.'<br><hr>';
                    }else{

                        $text = "por este motivo não foi possível enviar todas as leituras que esta na base da central do imóvel para a plataforma da MedirWeb.";

                        // ENVIAR EMAIL informando a falha de comunicação.
                        Mail::send('email.falhaCronAllLei', ['imovel'=> $imo->IMO_NOME, 'ip' => $imo->IMO_IP, 'codigoHTTP' => $codigoHTTP, 'text' => $text], function($message) use ($imo) {
                            $message->from('suporte@medirweb.com.br', 'MedirWeb - Plataforma individualizadora');
                            $message->to('suporte@medirweb.com.br');
                            $message->cc('contato@wi-id.com');
                            $message->cc('i.v.nascimento.ti@gmail.com');
                            $message->subject('Enviar Todas as Leitura para Plataforma');
                        });
                        // fim - enviar email

                        echo 'error: '.$imo->IMO_NOME.'<br><hr>';
                    }

                }
            }

        })->dailyAt('6:00');
*/

    }


    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
