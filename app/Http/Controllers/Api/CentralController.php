<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\Imovel;
use App\Models\Unidade;
use App\Models\Prumada;
use App\Models\Leitura;
USE App\Models\Fechamento;
use Session;

class CentralController extends Controller
{

    public function getPrumadas($ip)
    {

        $imovel = Imovel::where('IMO_IP', $ip)->first();
        $unidades = $imovel->getUnidades;
        $arrayPrumadas = array();

        foreach ($unidades as $unidade) {
            $prumadas = $unidade->getPrumadas;

            foreach ($prumadas as $prumada) {

                $dados['EQP_IDUNI'] = $unidade->UNI_ID;
                $dados['EQP_IDPRU'] = $prumada->PRU_ID;
                $dados['EQP_IDFUNCIONAL'] = $prumada->PRU_IDFUNCIONAL;

                array_push($arrayPrumadas, $dados);
            }
        }

        return response()->json(response()->make($arrayPrumadas), 200);
    }



    public function addLeituras(Request $request)
    {
        $dataForm = [
            "FEC_IDPRUMADA" => $request->LEI_IDPRUMADA,
            "FEC_METRO" => $request->LEI_METRO,
            "FEC_LITRO" => $request->LEI_LITRO,
            "FEC_MILILITRO" => $request->LEI_MILILITRO,
            "FEC_VALOR" => $request->LEI_VALOR
        ];
        // var_dump($dataForm);
        // echo $request->FEC_IDPRUMADA;
        $fechamento = Fechamento::where('FEC_IDPRUMADA', $dataForm['FEC_IDPRUMADA'])->first();

        if($fechamento != null) {
            $dataDB = explode('-',$fechamento->created_at);
            $mesAtual = date('m');
            $anoAtual = date('Y');
            if($dataDB[0] != $anoAtual && $dataDB[1] != $mesAtual) {
                Fechamento::create($dataForm);
            }
        }else {
            Fechamento::create($dataForm);
        }
        // Validação de mes
        // Leitura::create($dataForm);

        return response()->json($dataForm, 200);
    }

}
