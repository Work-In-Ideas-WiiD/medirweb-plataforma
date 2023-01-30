<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Unidade;
use App\Models\UnidadeAlerta as Alerta;

class CriarUnidadeAlerta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CriarUnidadeAlerta';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Procura as unidades que nao possui uma leitura nas ultimas 12 horas e cria um alerta';

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
        Unidade::whereDoesntHave('prumada.leitura', function($query) {
            $query->where('created_at', '>', now()->subHours(12));
        })->whereDoesntHave('alerta', function($query) {
            $query->where('created_at', '>', now()->subHours(12));
        })->whereNotNull('device')->chunk(1000, function($unidades) {
            foreach ($unidades as $unidade) {
                $insert[] = [
                    'unidade_id' => $unidade->id,
                    'device' => $unidade->device,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            Alerta::insert($insert); // aqui fazemos um insert massivo de até 1000 registros de uma unica vez
        });
    }
}
