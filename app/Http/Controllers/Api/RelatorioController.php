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

        $faturaImovel = Fatura::where('FAT_IMOID', $request->IMO_ID)->orderBy('FAT_DTLEIFORNECEDOR', 'desc')->take(3)->get();

        if ($faturaImovel->count() == 0) {
            return response()->json(['error' => 'Não existe fatura(s) cadastradas no sistema!'], 400);
        }
        Fatura::destroy($faturaImovel->FAT_ID);

        foreach ($faturaImovel as $fatImo) {
            $faturaUnidade = FaturaUnidade::where('FATUNI_IDUNI', $request->UNI_ID)->where('FATUNI_IDFATURA', $fatImo->FAT_ID)->get();

            array_push($dadosFatura, $faturaUnidade);
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

        if($imovel->IMO_ID == $request->input('IMO_ID')){

            $hidromentros = Unidade::find($request->input('UNI_ID'))->getPrumadas;

            foreach ($hidromentros as $hidromentro)
            {
                $leituraAnterior = $hidromentro->getLeituras()->where('created_at', '>=', date($request->input('CONSUMO_DATA_ANTERIOR')).' 00:00:00')->orderBy('created_at', 'asc')->first();

                $leituraAtual = $hidromentro->getLeituras()->where('created_at', '<=', date($request->input('CONSUMO_DATA_ATUAL')).' 23:59:59')->orderBy('created_at', 'desc')->first();

                // VALIDAÇÃO SE NAO TIVER LEITURA ANTEIOR
                if(!(isset($leituraAnterior))){
                  $leituraAnterior = $leituraAtual;
                }

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

            $equipamentos = Unidade::find($request->input('UNI_ID'))->getPrumadas;
            foreach ($equipamentos as $equipamento)
            {
                $leituraAnterior = $equipamento->getLeituras()->where('created_at', '>=', date($request->input('FATURA_DATA_ANTERIOR')).' 00:00:00')->orderBy('created_at', 'asc')->first();
                $leituraAtual = $equipamento->getLeituras()->where('created_at', '<=', date($request->input('FATURA_DATA_ATUAL')).' 23:59:59')->orderBy('created_at', 'desc')->first();

                // VALIDAÇÃO SE NAO TIVER LEITURA ANTEIOR
                if(!(isset($leituraAnterior))){
                  $leituraAnterior = $leituraAtual;
                }

                if(isset($leituraAnterior) && isset($leituraAtual))
                {
                    $consumo =  $leituraAtual->LEI_METRO - $leituraAnterior->LEI_METRO;
                    $valor = RelatorioController::tarifa($consumo);

                    $arrayDadosFaturaIndividual = array(
                        'UNI_ID' => $equipamento->PRU_IDUNIDADE,

                        'Imovel' => $equipamento->unidade->imovel->IMO_NOME,
                        'cnpjImovel' => $equipamento->unidade->imovel->IMO_CNPJ,
                        'Endereco' => $equipamento->unidade->imovel->IMO_LOGRADOURO." ".$equipamento->unidade->imovel->IMO_COMPLEMENTO.", Nº".$equipamento->unidade->imovel->IMO_NUMERO,
                        'Bairro' => $equipamento->unidade->imovel->IMO_BAIRRO,
                        'CityUF' => $equipamento->unidade->imovel->cidade->CID_NOME." - ".$equipamento->unidade->imovel->estado->EST_ABREVIACAO,
                        'CEP' => $equipamento->unidade->imovel->IMO_CEP,
                        'responsaveisImovel' => $equipamento->unidade->imovel->IMO_RESPONSAVEIS,
                        'responsaveisTelImovel' => $equipamento->unidade->imovel->IMO_TELEFONES,

                        'nomeAp' => $equipamento->unidade->UNI_NOME,
                        'responsavelAp' => $equipamento->unidade->UNI_RESPONSAVEL,
                        'responsavelCpfAp' => $equipamento->unidade->UNI_CPFRESPONSAVEL,
                        'responsavelTelAp' => $equipamento->unidade->UNI_TELRESPONSAVEL,

                        'PRU_ID' => $equipamento->PRU_ID,
                        'PRU_NOME' => $equipamento->PRU_NOME,
                        'LeituraAnterior' => $leituraAnterior->LEI_METRO,
                        'LeituraAtual' => $leituraAtual->LEI_METRO,
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
