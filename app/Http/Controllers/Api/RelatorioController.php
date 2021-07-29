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
       // $dadosFatura = [];
       $faturaImovel = FaturaUnidade::where('unidade_id', $request->user()->unidade_id)
            ->with('unidade.prumada')
            ->orderByDesc('prumada_data_leitura_atual')
            ->take(3)->get();

    
        if (!count($faturaImovel))
            return ['error' => 'Não existe fatura(s) cadastradas no sistema!'];

        return $faturaImovel;

        

        // foreach ($faturaImovel as $fatImo) {
        //     $faturaUnidade = FaturaUnidade::where('unidade_id', $request->UNI_ID)->where('fatura_id', $fatImo->id)->get();

        //     foreach ($faturaUnidade as $fatUni) {

        //         $prumadas = '['.$fatUni['FATUNI_PRUMADAS'].']';
        //         $fatUni['FATUNI_PRUMADAS'] = json_decode($prumadas);

        //         array_push($dadosFatura, $fatUni);
        //     }

        // }

        // return $dadosFatura;
    }

    public function tarifa($consumo){

        // if($consumo > 10 && $consumo <= 15) {
        //     $valor = (($consumo - 10) * 11.37) + 59;
        // } elseif ($consumo > 15) {
        //     $valor = (($consumo - 10) * 13.98) + 59;
        // } else {
        //     $valor = 59;
        // }

        $valor = $consumo * 10;

        return $valor;
    }

    public function consumo(Request $request)
    {
        $consumoAvancados = [];

        $imovel = Imovel::find($request->imovel_id);

        if($imovel) {

            $hidromentros = Prumada::where('unidade_id', $request->unidade_id)->get();

            foreach ($hidromentros as $hidromentro) {
                $leituraAnterior = $hidromentro->leitura()->whereDate('created_at', '<=', now()->firstOfMonth()->format('Y-m-d H:i:s'))->orderBy('created_at', 'DESC')->first();

                $leituraAtual = $hidromentro->leitura()->whereDate('created_at', '<=', now()->format('Y-m-d H:i:s'))->orderByDesc('created_at', 'DESC')->first();

                // VALIDAÇÃO SE NAO TIVER LEITURA ANTEIOR
                if(!isset($leituraAnterior)) {
                  $leituraAnterior = $leituraAtual;
                }

                if(isset($leituraAnterior) && isset($leituraAtual)) {
                    $consumo =  $leituraAtual->metro - $leituraAnterior->metro;

                    $valor = SELF::tarifa($consumo);

                    $relatorio_consumoAvancados = array(
                        'id' => $hidromentro->id,
                        'id_funcional' => $hidromentro->funcional_id,
                        'nome' => $hidromentro->nome,
                        'tipo' => $hidromentro->tipo,
                        'status' => $hidromentro->status,
                        'leitura_anterior' => $leituraAnterior->metro,
                        'leitura_anterior_litro' => $leituraAnterior->litro,
                        'leitura_anterior_mililitro' => $leituraAnterior->mililitro,
                        'leitura_atual' => $leituraAtual->metro,
                        'leitura_atual_litro' => $leituraAtual->litro,
                        'leitura_atual_mililitro' => $leituraAtual->mililitro,
                        'consumo' => $consumo,
                        'valor' => number_format($valor, 2, ',', '.'),
                        'data_leitura_anterior' => date('Y-m-6', strtotime($leituraAnterior->created_at)), //$leituraAnterior->created_at,
                        'data_leitura_atual' => date('Y-m-6', strtotime($leituraAtual->created_at)), // $leituraAtual->created_at,
                    );
                    array_push($consumoAvancados, $relatorio_consumoAvancados);
                }
            }
        } else {
            return ['error' => 'Imóvel não existe!'];
        }

        return $consumoAvancados;
    }

    public function fatura(Request $request)
    {
        // VALIDAÇÃO DATAS NÃO PASSAR DE 31 DIAS
        $date1=date_create($request->input('fatura_data_anterior'));
        $date2=date_create($request->input('fatura_data_atual'));
        $diff=date_diff($date1,$date2);
        $dias = $diff->format("%a");

        if($dias >= 32 ){
            return response()->json(['error' => 'Não é permitido datas maiores que 31 dias!'], 400);
        }
        // FIM - VALIDAÇÃO DATAS NÃO PASSAR DE 31 DIAS


        $imovel = Unidade::find($request->input('unidade_id'))->imovel;

        if($imovel->id == $request->input('imovel_id')){

            $dadosFaturaIndividual = array();

            $equipamentos = Unidade::find($request->input('unidade_id'))->prumada;
            foreach ($equipamentos as $equipamento)
            {
                $leituraAnterior = $equipamento->leitura()->where('created_at', '>=', date($request->input('fatura_data_anterior')).' 00:00:00')->orderBy('created_at', 'asc')->first();
                $leituraAtual = $equipamento->leitura()->where('created_at', '<=', date($request->input('fatura_data_atual')).' 23:59:59')->orderBy('created_at', 'desc')->first();

                // VALIDAÇÃO SE NAO TIVER LEITURA ANTEIOR
                if(!(isset($leituraAnterior))){
                  $leituraAnterior = $leituraAtual;
                }

                if(isset($leituraAnterior) && isset($leituraAtual))
                {
                    // dd($equipamento->unidade->telefone);
                    
                    $consumo =  $leituraAtual->metro - $leituraAnterior->metro;
                    $valor = RelatorioController::tarifa($consumo);

                    $arrayDadosFaturaIndividual = array(
                        'UNI_ID' => $equipamento->unidade_id,

                        'Imovel' => $equipamento->unidade->imovel->nome,
                        'cnpjImovel' => $equipamento->unidade->imovel->cnpj,
                        'Endereco' => $equipamento->unidade->imovel->endereco->logradouro." ".$equipamento->unidade->imovel->endereco->complemento.", Nº".$equipamento->unidade->imovel->endereco->numero,
                        'Bairro' => $equipamento->unidade->imovel->endereco->bairro,
                        'CityUF' => $equipamento->unidade->imovel->endereco->cidade->nome." - ".$equipamento->unidade->imovel->endereco->cidade->estado->codigo,
                        'CEP' => $equipamento->unidade->imovel->endereco->cep,
                        'responsaveisImovel' => $equipamento->unidade->imovel->responsavel ?? [],
                        'responsaveisTelImovel' => $equipamento->unidade->imovel->telefone ?? [],

                        'nomeAp' => $equipamento->unidade->nome,
                        'responsavelAp' => $equipamento->unidade->nome_responsavel,
                        'responsavelCpfAp' => $equipamento->unidade->cpf_responsavel,
                        'responsavelTelAp' => '(62) 3123-2312',

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
