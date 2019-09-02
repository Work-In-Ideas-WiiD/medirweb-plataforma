<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Cliente;
use App\Models\Imovel;
use App\Models\Prumada;
use App\Models\Timeline;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /* Dashboard */
        $datadehoje = Carbon::today();

        // Hidrometros ativos
        $pruAtivas = array();

        $timelines = Timeline::where('icone', "fa fa-check bg-green")->get();

        foreach ($timelines as $timeline) {
            $prumadasAtivas = Prumada::where('id', $timeline->TIMELINE_IDPRUMADA)->get();
            foreach ($prumadasAtivas as $prumadaAtiva) {

                $leituraAtual = $prumadaAtiva->getLeituras()->orderBy('created_at', 'desc')->first();

                $arrayPruAtivas = array(
                    'TIMELINE_ID' => $timeline->TIMELINE_ID,
                    'PRU_ID' => $prumadaAtiva->PRU_ID,
                    'PRU_NOME' => $prumadaAtiva->PRU_NOME,
                    'PRU_SERIAL' => $prumadaAtiva->PRU_SERIAL,
                    'localizacao' => $prumadaAtiva->unidade->imovel->cidade->CID_NOME." - ".$prumadaAtiva->unidade->imovel->estado->EST_ABREVIACAO,
                    'PRU_STATUS' => $prumadaAtiva->PRU_STATUS,
                    'leituraAtual' => $leituraAtual['LEI_VALOR'],
                    'PRU_OPERADORA' => $prumadaAtiva->PRU_OPERADORA,
                );
                array_push($pruAtivas, $arrayPruAtivas);
            }
        }

        return view('dashboard.ver', ['datacalendario' => $datadehoje, 'total_clientes' => Cliente::count(), 'total_imovel' => Imovel::count(),
        'ativos_hidrometros' => Prumada::where('status', 1)->count(), 'total_timeline' => Timeline::count(), 'pruAtivas' => $pruAtivas]);
    }

}
