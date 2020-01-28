<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\Agrupamento;
use App\Models\Imovel;
use App\Models\Unidade;
use App\Models\Prumada;
use App\Models\Leitura;
use App\Models\Fechamento;
use App\Models\Falha;
use App\Models\FaturaUnidade;

use Session, Curl;

class CentralController extends Controller
{

    public function getPrumadas($ip, $id = null)
    {
        $imovel = Imovel::with('unidade.prumada', 'unidade.agrupamento')->where('ip', '192.168.130.13')->first();
        // $imovel = Imovel::with('unidade.prumada', 'unidade.agrupamento')->where('ip', '192.168.130.4')->first();
        
        $arrayPrumadas = array();

        if ($imovel) {
            foreach ($imovel->unidade as $unidade) {
        
                foreach ($unidade->prumada as $prumada) {

                    if($prumada->funcional_id != ""){

                        $dados['EQP_IDUNI'] = $unidade->id;
                        $dados['EQP_IDPRU'] = $prumada->id;
                        $dados['EQP_IDFUNCIONAL'] = $prumada->funcional_id;
                        $dados['EQP_BLOCO'] = $unidade->agrupamento->nome;
                        $dados['EQP_IDREPETIDOR'] = $prumada->repetidor_id;

                        array_push($arrayPrumadas, $dados);
                    }
                }
            }
        }

        // if($id == 2)
        // {
        //     if ($imovel) {
        //         foreach ($imovel->unidade as $unidade) {
            
        //             foreach ($unidade->prumada as $prumada) {
    
        //                 if($prumada->funcional_id != ""){
    
        //                     $dados['EQP_IDUNI'] = $unidade->id;
        //                     $dados['EQP_IDPRU'] = $prumada->id;
        //                     $dados['EQP_IDFUNCIONAL'] = $prumada->funcional_id;
        //                     $dados['EQP_BLOCO'] = $unidade->agrupamento->nome;
        //                     $dados['EQP_IDREPETIDOR'] = $unidade->agrupamento->repetidor_segundo_id;
    
        //                     array_push($arrayPrumadas, $dados);
        //                 }
        //             }
        //         }
        //     }
        // }
        // else
        // {
        //     if ($imovel) {
        //         foreach ($imovel->unidade as $unidade) {
            
        //             foreach ($unidade->prumada as $prumada) {
    
        //                 if($prumada->funcional_id != ""){
    
        //                     $dados['EQP_IDUNI'] = $unidade->id;
        //                     $dados['EQP_IDPRU'] = $prumada->id;
        //                     $dados['EQP_IDFUNCIONAL'] = $prumada->funcional_id;
        //                     $dados['EQP_BLOCO'] = $unidade->agrupamento->nome;
        //                     $dados['EQP_IDREPETIDOR'] = $unidade->agrupamento->repetidor_id;
    
        //                     array_push($arrayPrumadas, $dados);
        //                 }
        //             }
        //         }
        //     }
        // }
        

        return response()->json(response()->make($arrayPrumadas), 200);
    }

    public function sicronizarLeituras($ip, $imovel = null)
    {
        if (!$imovel)
            $imovel = Imovel::where('ip', $ip)->first();
       
        
        $response = Curl::to('http://'.$imovel->host.'/leituras/')
        // $response = Curl::to('http://9c4320a6.ngrok.io/leituras/')
        ->get();

        $retornos = json_decode($response, TRUE);

        foreach($retornos ?? [] as $resp)
        {
            Leitura::firstOrCreate([
                "prumada_id" => $resp['LEI_IDPRUMADA'],
                "metro" => $resp['LEI_METRO'],
                "litro" => $resp['LEI_LITRO'],
                "mililitro" => $resp['LEI_MILILITRO'],
                "valor" => $resp['LEI_VALOR'],
                "created_at" => date('Y-m-d H:i:s', strtotime($resp['created_at']) ),
                "updated_at" => date('Y-m-d H:i:s', strtotime($resp['updated_at']) ),
            ]);

        }

        return ['success' => "Scronização Realizada"];

    }

    public function sicronizarFalhas($ip, $imovel = null)
    {
        if (!$imovel)
            $imovel = Imovel::where('ip', $ip)->first();
        
        $response = Curl::to('http://'.$imovel->host.'/falhas/')
        // $response = Curl::to('http://644cb506.ngrok.io/falhas/')
        ->get();

        $retornos = json_decode($response, TRUE);

        foreach($retornos as $resp)
        {
            Falha::firstOrCreate([
                "prumada_id" => $resp['FLH_IDPRU'],
                "status" => $resp['FLH_STATUS'],
                'repetidor' => $resp['FLH_IDREPETIDOR'] ?? null,
                "created_at" => date('Y-m-d', strtotime($resp['created_at']) ),
                "updated_at" => date('Y-m-d', strtotime($resp['updated_at']) ),
            ]);

        }

        return ['success' => "Scronização Realizada"];
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

    public function prumadasFalhas($imovel)
    {
        $prumadas_erro = [];

        $unidades = Unidade::has('prumada.unidade')->with('prumada:id,unidade_id,funcional_id')->where('imovel_id', $imovel)->get(['id']);

        $dias_atras = [
            now()->subDays(1),
            now()->subDays(2),
            now()->subDays(3),
        ];

        foreach ($unidades as $unidade) {

            foreach ($unidade->prumada as $prumada) {

                $leitura_erro = 0;

                foreach ($dias_atras as $dia) {

                    $leitura = $prumada->leitura()->whereDate('created_at', $dia)->exists();

                    if (!$leitura and $prumada->funcional_id) {
                        $leitura_erro += 1;
                    }
                }

                if ($leitura_erro == 3) {
                    $prumadas_erro['prumadas_com_falha'][] = $prumada->funcional_id;
                }
            }

        }

        if ($prumadas_erro) {
            $prumadas_erro['total_falhas'] = count($prumadas_erro['prumadas_com_falha']);
            return $prumadas_erro;
        }

        return 'nenhum erro de leitura encontrado!';
    }

    public function imovelConsumoMedio(Request $request)
    {
        return $this->_imovelConsumoMedio(
            $request->imovel ?? '',
            $request->bloco ?? '',
            $request->apartamento ?? ''
        );
    }


    private function _imovelConsumoMedio($imovel, $bloco, $apartamento)
    {
        //primeiro pegamos o agrupamento usando o imovel e o bloco
        $agrupamento = Agrupamento::where('imovel_id', $imovel)->where('nome', $bloco)->first();

        if ($agrupamento) {
            $unidade = $agrupamento->unidade()->where('nome', $apartamento)->first();

            if ($unidade) {
                
                return [
                    'consumo_consolidado' => '',
                    'consumo_medio' => '',
                    'consumo_estimado' => '',
                    'media_consumo_todas_unidades' => '',
                    'media_consumo_por_dia_todas_unidades_mes_anterior' => '',
                    'media_consumo_por_dia_todas_unidades_mes_atual' => '',
                ]; 
                
            } else {
                return ['error' => 'apartamento não encontrado.'];
            }

        } else {
            return ['error' => 'imóvel ou bloco não são válidos'];
        }
    }

    public function imovelMediaConsumo(Request $request)
    {
        return $this->_imovelMediaConsumo(
            $request->imovel ?? '',
            $request->bloco ?? '',
            $request->apartamento ?? ''
        );
    }


    private function _imovelMediaConsumo($imovel, $bloco, $apartamento)
    {
        //primeiro pegamos o agrupamento usando o imovel e o bloco
        $agrupamento = Agrupamento::where('imovel_id', $imovel)->where('nome', $bloco)->first();

        if ($agrupamento) {
            $unidade = $agrupamento->unidade()->with('prumada:id,unidade_id')->where('nome', $apartamento)->first();

            if ($unidade) {

                return [
                    'quantidade_moradores' => $unidade->quantidade_moradores,
                    'consumo_consolidado' => $this->_imovelConsumoConsolidadoFatura($unidade),
                    'consumo_medio_por_dia' => $this->_imovelConsumoMedioPorDia($unidade),
                    'consumo_estimado' => $this->_imovelConsumoEstimado($unidade),
                    'media_consumo_todas_unidades_quantidade_moradores' => $this->_imovelConsumoTodasUnidades($unidade),
                    'media_consumo_por_dia_todas_unidades_quantidade_moradores_dia' => $this->_imovelConsumoTodasUnidadesMesAnterior($unidade),
                    'media_consumo_por_dia_todas_unidades_mes_atual' => $this->_imovelConsumoTodasUnidadesMesAtual($unidade),
                    
                ]; 
                
            } else {
                return ['error' => 'apartamento não encontrado.'];
            }

        } else {
            return ['error' => 'imóvel ou bloco não são válidos'];
        }
    }

    private function _imovelConsumoConsolidado($unidade, $data = ['data1' => null, 'data2' => null])
    {
        $diferenca = 0;

        if (empty($data['data1']))
            $data['data1'] = now()->subMonth(1)->day(1)->format('Y-m-d');

        if (empty($data['data2']))
            $data['data2'] = now()->subMonth(1)->day(-0)->format('Y-m-d');

        foreach ($unidade->prumada as $prumada) {
            $leitura_anterior = $prumada->leitura()
                ->whereDate('created_at', $data['data1'])
                ->orderByDesc('id')->first();
            
            $leitura_atual = $prumada->leitura()
                ->whereDate('created_at', '<=', $data['data2'])
                ->orderByDesc('id')->first();

            $diferenca += ($leitura_atual->metro ?? 0) - ($leitura_anterior->metro ?? 0);
        }

        return $diferenca;
    }

    private function _imovelConsumoConsolidadoFatura($unidade, $data = ['data1' => null, 'data2' => null])
    {
        $diferenca = 0;

        if (empty($data['data1']))
            $data['data1'] = now()->subMonth(1)->day(-0)->format('Y-m-d');

        if (empty($data['data2']))
            $data['data2'] = now()->subMonth(0)->day(-0)->format('Y-m-d');

        
        $diferenca = FaturaUnidade::whereDate('prumada_data_leitura_anterior', $data['data1'])->whereDate('prumada_data_leitura_atual', $data['data2'])->where('unidade_id', $unidade->id)->orderByDesc('id')->first();
       
        return $diferenca->prumada_consumo ?? 0;
    }

    private function _imovelConsumoConsolidadoFaturaSoma($unidade, $data = ['data1' => null, 'data2' => null])
    {
        $diferenca = 0;

        if (empty($data['data1']))
            $data['data1'] = now()->subMonth(1)->day(-0)->format('Y-m-d');

        if (empty($data['data2']))
            $data['data2'] = now()->subMonth(0)->day(-0)->format('Y-m-d');

        if($unidade->quantidade_moradores === NULL)
            $unidade->quantidade_moradores = 3;
        
        $unidades = Unidade::where('quantidade_moradores', $unidade->quantidade_moradores)->where('imovel_id', $unidade->imovel_id)->get();

        foreach ($unidades as $und) {

            $cosumo = FaturaUnidade::whereDate('prumada_data_leitura_anterior', $data['data1'])->whereDate('prumada_data_leitura_atual', $data['data2'])->where('unidade_id', $und->id)->orderByDesc('id')->first();

            $diferenca += $cosumo->prumada_consumo;
        }
       
        return $diferenca;
    }


    private function _imovelConsumoMedioPorDia($unidade)
    {
        $consumo = $this->_imovelConsumoConsolidadoFatura($unidade);

        return $this->_imovelConsumoDivisao($consumo, now()->day(-0)->format('d'));
    }

    private function _imovelConsumoEstimado($unidade)
    {
        return $this->_imovelConsumoConsolidado($unidade, [
            'data1' => now()->day(1)->format('Y-m-d'),
            'data2' => now()->format('Y-m-d')
        ]);

    }

    private function _imovelConsumoTodasUnidades($unidade)
    {
        //
        $consumo = $this->_imovelConsumoConsolidadoFaturaSoma($unidade);

        // dd(Unidade::where('quantidade_moradores', $unidade->quantidade_moradores)->where('imovel_id', $unidade->imovel_id)->count(), $consumo);

        return $this->_imovelConsumoDivisao($consumo, (Unidade::where('quantidade_moradores', $unidade->quantidade_moradores)->where('imovel_id', $unidade->imovel_id)->count() ?? 3));
    }

    private function _imovelConsumoTodasUnidadesMesAnterior($unidade)
    {
        //
        //
        // $consumo = $this->_imovelConsumoConsolidado($unidade, [
        //     'data1' => now()->day(1)->format('Y-m-d'),
        //     'data2' => now()->format('Y-m-d')
        // ]);

        $consumo = $this->_imovelConsumoConsolidadoFaturaSoma($unidade);

        $media_morador = $this->_imovelConsumoDivisao($consumo, (Unidade::where('quantidade_moradores', $unidade->quantidade_moradores)->where('imovel_id', $unidade->imovel_id)->count() ?? 3));

        return $this->_imovelConsumoDivisao($media_morador, now()->day(-0)->format('d'));
    }

    private function _imovelConsumoTodasUnidadesMesAtual($unidade)
    {
        $consumo = $this->_imovelConsumoConsolidado($unidade, [
            'data1' => now()->day(1)->format('Y-m-d'),
            'data2' => now()->format('Y-m-d')
        ]);

        return $this->_imovelConsumoDivisao($consumo, now()->format('d'));
    }

    private function _imovelConsumoDivisao($n1, $n2)
    {
        if ($n2 != 0) {
            $result = floatval($n1) / floatval($n2);
        } else {
            $result = $n1;
        }

        return (float) number_format($result, 2);
    }

}
