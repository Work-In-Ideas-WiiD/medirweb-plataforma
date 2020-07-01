<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agrupamento;
use App\Models\Prumada;
use App\Models\Leitura;
use App\Models\Unidade;

class SindicoController extends Controller
{
    private $mes = [
        1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
        5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
        9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
    ];

    public function painel()
    {
        $unidades = auth()->user()->imovel->unidade()->count();

        $prumadas = Prumada::whereHas('unidade', function($query) {
            $query->where('imovel_id', auth()->user()->imovel_id);
        })->pluck('id');

        $consumo_total_mensal = $this->consumoMensal($prumadas, now()->month);

        for ($mes = 1; $mes <= 12; $mes++) {
            $consumo_mes[$mes] = $this->consumoMensal($prumadas, $mes);
        }

        $consumo_medio_por_unidade_mensal = number_format($consumo_total_mensal / $unidades, 2);

        $consumo_ultimos_6meses = $this->ultimos6Meses($prumadas, auth()->user()->imovel_id);

        $mes = $this->mes;

        return view('sindico.painel', compact(
            'unidades',
            'prumadas',
            'consumo_total_mensal',
            'consumo_medio_por_unidade_mensal',
            'consumo_mes',
            'consumo_ultimos_6meses',
            'mes',
        ));
    }


    private function consumoMensal($prumadas, $month, $bloco = null, $unidade = null)
    {
        #aqui montamos um queryBuilder base
        $queryBulder = Leitura::whereIn('prumada_id', $prumadas)
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', $month);


        if ($bloco or $unidade) {
            $queryBulder->whereHas('prumada.unidade', function($query) use ($bloco, $unidade) {
                if ($unidade) {
                    $query->where('nome', $unidade);
                }
                    
                if ($bloco and false) {
                    $query->whereHas('agrupamento', function($subquery) use ($bloco) {
                        $subquery->where('nome', $bloco);
                    });
                }
            });

        }
        
        return $queryBulder->sum('consumo');
    }

    private function mesAntes($mes)
    {
        $data = now()->subMonth($mes);

        if (now()->day == 30) {
            $data = now()->subMonth($mes)->subDay(1);
        }

        return $data->month;
    }

    private function montarMeses($array)
    {
        //basta informar um array, a quantidade de indices irá determianr a quantidade de meses
        $novo_array = [];

        for ($mes = 0; $mes < count($array); $mes++) {
            $data = now()->subMonth($mes);

            if (array_key_exists($data->month, $novo_array)) {
                $data = now()->subMonth($mes)->subDay(1);
            }

            $novo_array[$data->month] = $array[$mes];

        }

        return $novo_array;
    }

    private function ultimos6Meses($prumadas, $imovel_id)
    {

        $blocos = Agrupamento::where('imovel_id', $imovel_id)->orderBy('nome')->get(['id', 'nome']);

        foreach ($blocos as $bloco) {

            $consumo[$bloco->nome] = $this->montarMeses([
                $this->consumoMensal($prumadas, $this->mesAntes(5), $bloco->nome),
                $this->consumoMensal($prumadas, $this->mesAntes(4), $bloco->nome),
                $this->consumoMensal($prumadas, $this->mesAntes(3), $bloco->nome),
                $this->consumoMensal($prumadas, $this->mesAntes(2), $bloco->nome),
                $this->consumoMensal($prumadas, $this->mesAntes(1), $bloco->nome),
                $this->consumoMensal($prumadas, $this->mesAntes(0), $bloco->nome),                
            ]);
        }

        return $consumo;
    }

    public function busca() {
        $imovel_id = auth()->user()->imovel_id;

        $termos = explode(',', request()->termos ?? '');

        $queryBulder = Unidade::where('imovel_id', $imovel_id);

        if (strpos($termos[0], '__BLOCO__')) {
            $queryBulder->whereHas('agrupamento', function($query) use ($termos){
                $query->where('nome', str_replace('__BLOCO__', '', $termos[0]));
            });
        }

        return $queryBulder->where(function($query) use ($termos) {
            foreach ($termos as $termo) {
                $query->where('nome', 'like', "%{$termo}%");
                $query->orWhere('nome_responsavel', 'like', "%{$termo}%");
                $query->orWhere('cpf_responsavel', 'like', "%{$termo}%");
                $query->orWhereHas('agrupamento', function($query) use ($termo){
                    $query->where('nome', 'like', "%{$termo}%");
                });
            }

        })->get();
    }

    public function unidade(Request $request)
    {
        $imovel_id = auth()->user()->imovel_id;

        $blocos = Agrupamento::where('imovel_id', $imovel_id)->get(['id', 'nome']);

        $mes = $this->mes;

        return view('sindico.unidade', compact('blocos', 'mes'));
    }

    public function consumoPorUnidade(Request $request)
    {
        return view('sindico.consumo-por-unidade');
    }

    public function consumoPorBlocoUltimos6Meses(Request $request, $bloco)
    {
        $prumadas = Prumada::whereHas('unidade', function($query) {
            $query->where('imovel_id', auth()->user()->imovel_id);
        })->get(['id']);
        
        $unidades = Unidade::with('agrupamento')->where('imovel_id', auth()->user()->imovel_id)
            ->whereHas('agrupamento', function($query) use ($bloco) {
                $query->where('nome', $bloco);
        })->get();

        foreach ($unidades as $unidade) {
            $consumo[$unidade->nome] = $this->montarMeses([
                $this->consumoMensal($prumadas, $this->mesAntes(0), $unidade->agrupamento->nome, $unidade->nome),
                $this->consumoMensal($prumadas, $this->mesAntes(1), $unidade->agrupamento->nome, $unidade->nome),
                $this->consumoMensal($prumadas, $this->mesAntes(2), $unidade->agrupamento->nome, $unidade->nome),
                $this->consumoMensal($prumadas, $this->mesAntes(3), $unidade->agrupamento->nome, $unidade->nome),
                $this->consumoMensal($prumadas, $this->mesAntes(4), $unidade->agrupamento->nome, $unidade->nome),
                $this->consumoMensal($prumadas, $this->mesAntes(5), $unidade->agrupamento->nome, $unidade->nome),                
            ]);
            // pode ser que no primeiro e ultimo dia do mes as informações apareçam de forma incorreta por causa do calculo de data
        }

        return $consumo;
    }

    public function listaDeLeitura(Request $request)
    {
        return view('sindico.lista-de-leitura');
    }

    public function comparativoDeConsumo(Request $request)
    {
        return view('sindico.comparativo-de-consumo');
    }
}
