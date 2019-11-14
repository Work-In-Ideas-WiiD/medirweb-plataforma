<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Imovel;

use App\Http\Controllers\Api\CentralController;

class ConsumirLeitura extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ConsumirLeitura';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Esse comando vai sincronizar as leituras';

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
        $central = new CentralController;

        Imovel::select('id', 'ip', 'porta')->whereNotNull('ip')->chunk(5, function ($imoveis) use ($central) {
            foreach ($imoveis as $imovel) {
                $central->sicronizarLeituras(null, $imovel);
            }
        });
    }
}
