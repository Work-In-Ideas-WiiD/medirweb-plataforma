<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\Imovel;
use App\Models\Unidade;
use App\Models\Fatura;
use App\Models\Prumada;
use App\Models\FaturaUnidade;

class RelatorioController extends Controller
{

    public function historicoFaturas(Request $request)
    {
        $dadosFatura = array();

        $faturaImovel = Fatura::where('imovel_id', $request->IMO_ID)->orderBy('data_leitura_fornecedor', 'desc')->take(3)->get();

        if ($faturaImovel->count() == 0) {
            return response()->json(['error' => 'Não existe fatura(s) cadastradas no sistema!'], 400);
        }

        foreach ($faturaImovel as $fatImo) {
            $faturaUnidade = FaturaUnidade::where('unidade_id', $request->UNI_ID)->where('fatura_id', $fatImo->id)->get();

            foreach ($faturaUnidade as $fatUni) {

                $prumadas = '['.$fatUni['FATUNI_PRUMADAS'].']';
                $fatUni['FATUNI_PRUMADAS'] = json_decode($prumadas);

                array_push($dadosFatura, $fatUni);
            }

        }

        return response()->json(response()->make($dadosFatura), 200);
    }

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

        if($imovel->id == $request->input('IMO_ID')){

            $hidromentros = Unidade::find($request->input('UNI_ID'))->prumada;

            foreach ($hidromentros as $hidromentro)
            {
                $leituraAnterior = $hidromentro->leitura()->where('created_at', '>=', date($request->input('consumo_data_anterior')).' 00:00:00')->orderBy('created_at', 'asc')->first();

                $leituraAtual = $hidromentro->leitura()->where('created_at', '<=', date($request->input('consumo_data_atal')).' 23:59:59')->orderBy('created_at', 'desc')->first();

                // VALIDAÇÃO SE NAO TIVER LEITURA ANTEIOR
                if(!(isset($leituraAnterior))){
                  $leituraAnterior = $leituraAtual;
                }

                if(isset($leituraAnterior) && isset($leituraAtual))
                {
                    $consumo =  $leituraAtual->LEI_METRO - $leituraAnterior->LEI_METRO;

                    $valor = RelatorioController::tarifa($consumo);

                    $relatorio_consumoAvancados = array(
                        'PRU_ID' => $hidromentro->id,
                        'PRU_NOME' => $hidromentro->nome,
                        'PRU_TIPO' => $hidromentro->tipo,
                        'PRU_STATUS' => $hidromentro->status,
                        'LeituraAnterior' => $leituraAnterior->metro,
                        'LeituraAtual' => $leituraAtual->metro,
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

    public function fatura(Request $request)
    {
        // VALIDAÇÃO DATAS NÃO PASSAR DE 31 DIAS
        $date1=date_create($request->input('FATURA_DATA_ANTERIOR'));
        $date2=date_create($request->input('FATURA_DATA_ATUAL'));
        $diff=date_diff($date1,$date2);
        $dias = $diff->format("%a");

        if($dias >= 32 ){
            return response()->json(['error' => 'Não é permitido datas maiores que 31 dias!'], 400);
        }
        // FIM - VALIDAÇÃO DATAS NÃO PASSAR DE 31 DIAS


        $imovel = Unidade::find($request->input('UNI_ID'))->imovel;

        if($imovel->IMO_ID == $request->input('IMO_ID')){

            $dadosFaturaIndividual = array();

            $equipamentos = Unidade::find($request->input('UNI_ID'))->prumada;
            foreach ($equipamentos as $equipamento)
            {
                $leituraAnterior = $equipamento->leitura()->where('created_at', '>=', date($request->input('FATURA_DATA_ANTERIOR')).' 00:00:00')->orderBy('created_at', 'asc')->first();
                $leituraAtual = $equipamento->leitura()->where('created_at', '<=', date($request->input('FATURA_DATA_ATUAL')).' 23:59:59')->orderBy('created_at', 'desc')->first();

                // VALIDAÇÃO SE NAO TIVER LEITURA ANTEIOR
                if(!(isset($leituraAnterior))){
                  $leituraAnterior = $leituraAtual;
                }

                if(isset($leituraAnterior) && isset($leituraAtual))
                {
                    $consumo =  $leituraAtual->metro - $leituraAnterior->metro;
                    $valor = RelatorioController::tarifa($consumo);

                    $arrayDadosFaturaIndividual = array(
                        'UNI_ID' => $equipamento->PRU_IDUNIDADE,

                        'Imovel' => $equipamento->unidade->imovel->nome,
                        'cnpjImovel' => $equipamento->unidade->imovel->cnpj,
                        'Endereco' => $equipamento->unidade->imovel->endereco->logradouro." ".$equipamento->unidade->imovel->endereco->complemento.", Nº".$equipamento->unidade->imovel->endereco->numero,
                        'Bairro' => $equipamento->unidade->imovel->endereco->bairro,
                        'CityUF' => $equipamento->unidade->imovel->endereco->cidade->nome." - ".$equipamento->unidade->imovel->endereco->cidade->estado->codigo,
                        'CEP' => $equipamento->unidade->imovel->endereco->cep,
                        'responsaveisImovel' => $equipamento->unidade->imovel->IMO_RESPONSAVEIS ?? null,
                        'responsaveisTelImovel' => $equipamento->unidade->imovel->IMO_TELEFONES ?? null,

                        'nomeAp' => $equipamento->unidade->nome,
                        'responsavelAp' => $equipamento->unidade->nome_responsavel,
                        'responsavelCpfAp' => $equipamento->unidade->cpf_responsavel,
                        'responsavelTelAp' => $equipamento->unidade->telefone->numero,

                        'PRU_ID' => $equipamento->id,
                        'PRU_NOME' => $equipamento->nome,
                        'LeituraAnterior' => $leituraAnterior->metro,
                        'LeituraAtual' => $leituraAtual->metro,
                        'Consumo' => $consumo,
                        'Valor' => number_format($valor, 2, ',', '.'),
                        'ValorSemFormato' => $valor,
                        'DataLeituraAnterior' => date('d/m/Y', strtotime($leituraAnterior->created_at)),
                        'DataLeituraAtual' => date('d/m/Y', strtotime($leituraAtual->created_at)),
                    );

                    array_push($dadosFaturaIndividual, $arrayDadosFaturaIndividual);
                }
            }

            $dir = public_path('upload/temp/faturas/');

            // EXCLUINDO DIRETORIO QUE NÃO É DE HOJE
            for ($m=1; $m <= 12; $m++) {
                for ($d=1; $d <= 31; $d++) {
                    $dt = date("Y-m-d", strtotime(date("Y").'-'.$m.'-'.$d));

                    if(!($dt == date("Y-m-d"))){
                        if (File::exists($dir.$dt.'/')) {
                            File::deleteDirectory($dir.$dt.'/');
                        }
                    }
                }
            }

            // CRIANDO DIRETORIO
            if (!(File::exists($dir.date("Y-m-d").'/'))){
                File::makeDirectory($dir.date("Y-m-d").'/');
            }

            // NOME DO ARQUIVO ALEATORIO
            $fatura['fileName'] = date("Y-m-d").'/'.str_random(10).".pdf";

            \PDF::loadView('relatorio.pdf.fatura_individual', compact('dadosFaturaIndividual'))
            ->save($dir.$fatura['fileName']);

            return response()->json(response()->make($fatura), 200);
        }else{
            return response()->json(['error' => 'Unidade não existe!'], 400);
        }

    }


}
