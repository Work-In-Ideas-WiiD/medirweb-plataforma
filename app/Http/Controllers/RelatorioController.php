<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imovel;
use App\Models\Unidade;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LeituraExport;

class RelatorioController extends Controller
{
    public function index()
    {
        //
    }

    public function relatorioConsumo()
    {
        $imoveis = ['' => 'Selecionar Imovel'];
        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel){
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
        }

        return view('relatorio.consumo', compact('imoveis'));
    }

    public function getConsumoLista(Request $request)
    {

        // FORMULARIO IMOVEL (GET)
        $imoveis = ['' => 'Selecionar Imovel'];
        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel){
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
        }
        // FIM - FORMULARIO IMOVEL (GET)

        // VALIDAÇÃO CAMPO IMOVEL
        if(empty($request->input('CONSUMO_IMOVEL'))){
            return redirect('/relatorio/consumo')->with('error', 'Por Favor Selecione o Imóvel.');
        }
        // FIM - VALIDAÇÃO CAMPO IMOVEL

        // SUBMIT "EXPORTAR EXCEL"
        if($request->export == "excel"){
            return Excel::download(new LeituraExport($request->input('CONSUMO_IMOVEL'), $request->input('CONSUMO_DATA_ANTERIOR'), $request->input('CONSUMO_DATA_ATUAL')), 'relatorio_consumo.xlsx');
        }

        // SUBMIT "FILTRAR"
        if($request->filtrar == "filtrar"){

            //Validação se esta vazio campo hidrometro
            if(empty($request->PRU_ID) || ($request->PRU_ID == "Selecione Hidrômetro")){

                // RESULTADO DA PESQUISA CONSUMO COMPLETO
                $consumos = array();
                $consumoAvancados = null;

                $unidades = Imovel::find($request->input('CONSUMO_IMOVEL'))->getUnidades;
                foreach ($unidades as $unid) {
                    $prumadas = Unidade::find($unid->UNI_ID)->getPrumadas;
                    foreach ($prumadas as $prumada)
                    {
                        $leituraAnterior = $prumada->getLeituras() ->where('created_at', '>=', date($request->input('CONSUMO_DATA_ANTERIOR')).' 00:00:00')->orderBy('created_at', 'asc')->first();

                        $leituraAtual = $prumada->getLeituras() ->where('created_at', '<=', date($request->input('CONSUMO_DATA_ATUAL')).' 23:59:59')->orderBy('created_at', 'desc')->first();

                        if(isset($leituraAnterior) && isset($leituraAtual))
                        {
                            $consumo =  $leituraAtual->LEI_METRO - $leituraAnterior->LEI_METRO;

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


                            $relatorio_consumos = array(
                                'Imovel' => $unid->imovel->IMO_NOME,
                                'IndiceGeral' => $prumada->PRU_ID,
                                'Nomes' => $unid->UNI_RESPONSAVEL,
                                'Apartamentos' => $unid->UNI_NOME,
                                'LeituraAnterior' => $leituraAnterior->LEI_METRO,
                                'LeituraAtual' => $leituraAtual->LEI_METRO,
                                'Consumo' => $consumo,
                                'Valor' => number_format($valor, 2, ',', '.'),
                                'DataLeituraAnterior' => date('d/m/Y - H:i', strtotime($leituraAnterior->created_at)),
                                'DataLeituraAtual' => date('d/m/Y - H:i', strtotime($leituraAtual->created_at)),
                            );

                            array_push($consumos, $relatorio_consumos);
                        }
                    }
                }
            }else{
                // RESULTADO DA PESQUISA CONSUMO AVANÇADO

                $consumos = null;
                $consumoAvancados = array();


                $hidromentros = Unidade::find($request->input('PRU_ID'))->getPrumadas;

                foreach ($hidromentros as $hidromentro)
                {
                    $leituraAnterior = $hidromentro->getLeituras() ->where('created_at', '>=', date($request->input('CONSUMO_DATA_ANTERIOR')).' 00:00:00')->orderBy('created_at', 'asc')->first();

                    $leituraAtual = $hidromentro->getLeituras() ->where('created_at', '<=', date($request->input('CONSUMO_DATA_ATUAL')).' 23:59:59')->orderBy('created_at', 'desc')->first();

                    if(isset($leituraAnterior) && isset($leituraAtual))
                    {
                        $consumo =  $leituraAtual->LEI_METRO - $leituraAnterior->LEI_METRO;

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


                        $relatorio_consumoAvancados = array(
                            'IndiceGeral' => $hidromentro->PRU_ID,
                            'LeituraAnterior' => $leituraAnterior->LEI_METRO,
                            'LeituraAtual' => $leituraAtual->LEI_METRO,
                            'Consumo' => $consumo,
                            'Valor' => number_format($valor, 2, ',', '.'),
                            'DataLeituraAnterior' => date('d/m/Y - H:i', strtotime($leituraAnterior->created_at)),
                            'DataLeituraAtual' => date('d/m/Y - H:i', strtotime($leituraAtual->created_at)),
                        );

                        array_push($consumoAvancados, $relatorio_consumoAvancados);
                    }
                }

            }
        }


        return view('relatorio.consumo', ['consumos'=>$consumos, 'imoveis' =>$imoveis, 'consumoAvancados' => $consumoAvancados]);
    }

    public function showPrumada($id)
    {
        $retorno = array();

        $unidades = Imovel::find($id)->getUnidades;
        foreach ($unidades as $unid) {
            $prumadas = Unidade::find($unid->UNI_ID)->getPrumadas;
            foreach ($prumadas as $prumada)
            {
                $pru = ['PRU_ID' => $prumada->PRU_ID,
                'UNI_NOME' => $prumada->unidade->UNI_NOME];
                array_push($retorno, $pru);
            }

            if(is_null($pru)){
                return redirect( URL::previous() );
            }
        }

        return json_encode($retorno);
    }

}
