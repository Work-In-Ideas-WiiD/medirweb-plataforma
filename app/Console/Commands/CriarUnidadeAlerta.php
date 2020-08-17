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
        $unidades = Unidade::whereDoesntHave('prumada.leitura', function($query) {
            $query->where('created_at', '>', now()->subHours(12));
        })->whereNotNull('device')->chunk(100, function($unidades) {
            foreach ($unidades as $unidade) {
                $this->criarAlerta($unidade);
            }
        });
    }

    private function criarAlerta($unidade)
    {
        
    }
}
