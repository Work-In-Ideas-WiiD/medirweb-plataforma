<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Imovel;
use App\Models\Unidade;

class RelatorioController extends Controller
{

    public function tarifa($consumo){

        if($consumo > 10 && $consumo <= 15)
        {
            $valor = (($consumo - 10) * 11.37) + 59;
        }
        elseif ($consumo > 15)
        {
            $valor = (($consumo - 10) * 13.98) + 59;
        }
        else
        {
            $valor = 59;
        }

        return $valor;
    }

    public function consumo(Request $request)
    {
        $consumoAvancados = array();

        $imovel = Unidade::find($request->input('UNI_ID'))->imovel;

        if($imovel->IMO_ID == $request->input('IMO_ID')){

            $hidromentros = Unidade::find($request->input('UNI_ID'))->getPrumadas;

            foreach ($hidromentros as $hidromentro)
            {
                $leituraAnterior = $hidromentro->getLeituras() ->where('created_at', '>=', date($request->input('CONSUMO_DATA_ANTERIOR')).' 00:00:00')->orderBy('created_at', 'asc')->first();

                $leituraAtual = $hidromentro->getLeituras() ->where('created_at', '<=', date($request->input('CONSUMO_DATA_ATUAL')).' 23:59:59')->orderBy('created_at', 'desc')->first();

                if(isset($leituraAnterior) && isset($leituraAtual))
                {
                    $consumo =  $leituraAtual->LEI_METRO - $leituraAnterior->LEI_METRO;

                    $valor = RelatorioController::tarifa($consumo);

                    $relatorio_consumoAvancados = array(
                        'PRU_ID' => $hidromentro->PRU_ID,
                        'PRU_NOME' => $hidromentro->PRU_NOME,
                        'LeituraAnterior' => $leituraAnterior->LEI_METRO,
                        'LeituraAtual' => $leituraAtual->LEI_METRO,
                        'Consumo' => $consumo,
                        'Valor' => number_format($valor, 2, ',', '.'),
                        'DataLeituraAnterior' => date('d/m/Y', strtotime($leituraAnterior->created_at)),
                        'DataLeituraAtual' => date('d/m/Y', strtotime($leituraAtual->created_at)),
                    );
                    array_push($consumoAvancados, $relatorio_consumoAvancados);
                }
            }
        }else{
            return response()->json(['error' => 'Unidade não existe!'], 400);
        }

        return response()->json(response()->make($consumoAvancados), 200);
    }



}
