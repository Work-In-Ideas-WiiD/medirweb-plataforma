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
        })->count();

        $consumo_total_mensal = $this->consumoMensal(['mes' => now()->month, 'ano' => now()->year]);

        for ($mes = 1; $mes <= 12; $mes++) {
            $consumo_mes[$mes] = $this->consumoMensal(['mes' => $mes, 'ano' => now()->year]);
        }

        $consumo_medio_por_unidade_mensal = number_format($consumo_total_mensal / $unidades, 2);

        $consumo_ultimos_6meses = $this->ultimosPorBlocoMeses(0, 5);

        $mes = $this->mes;

        return view('sindico.painel', compact(
            'prumadas',
            'unidades',
            'consumo_total_mensal',
            'consumo_medio_por_unidade_mensal',
            'consumo_mes',
            'consumo_ultimos_6meses',
            'mes',
        ));
    }


    private function consumoMensal($array)
    {
        return Leitura::whereHas('prumada.unidade', function($query) {
                $query->where('imovel_id', auth()->user()->imovel_id);
            })->when($array['ano'] ?? null, function($query, $ano) {
                $query->whereYear('created_at', $ano);
            })->when($array['mes'] ?? null, function($query, $mes) {
                $query->whereMonth('created_at', $mes);
            })->when($array['dia'] ?? null, function($query, $dia) {
                $query->whereDay('created_at', $dia);
            })->when($array['unidade'] ?? null, function($query, $unidade) {
                $query->whereHas('prumada.unidade', function($subquery) use ($unidade) {
                    $subquery->where('nome', $unidade);
                });
            })->when($array['bloco'] ?? null, function($query, $bloco) {
                $query->whereHas('prumada.unidade.agrupamento', function($subquery) use ($bloco) {
                    $subquery->where('nome', $bloco);
                });
            })->sum('consumo');
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

    private function ultimosPorBlocoMeses($primeiro_mes, $ultimo_mes)
    {
        $blocos = Agrupamento::where('imovel_id', auth()->user()->imovel_id)->orderBy('nome')->get(['nome']);

        foreach ($blocos as $bloco) {
            $consumo_por_meses = [];

            foreach (range($ultimo_mes, $primeiro_mes) as $mes) {
                $consumo_por_meses[] = $this->consumoMensal([
                    'mes' => $this->mesAntes($mes),
                    'bloco' => $bloco->nome,
                ]);
            }

            $consumo[$bloco->nome] = $consumo_por_meses;
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
        $blocos = Agrupamento::where('imovel_id', auth()->user()->imovel_id)->orderBy('nome')->get(['nome']);

        return view('sindico.consumo-por-unidade', compact('blocos'));
    }

    public function consumoPorBlocoEUnidade(Request $request, $bloco, $primeiro_mes, $ultimo_mes)
    {
        $unidades = Unidade::with('agrupamento')->where('imovel_id', auth()->user()->imovel_id)
            ->whereHas('agrupamento', function($query) use ($bloco) {
                $query->where('nome', $bloco);
        })->get();

        foreach ($unidades as $unidade) {
            $consumo_por_meses = [];

            foreach (range($ultimo_mes, $primeiro_mes) as $mes) {
                $consumo_por_meses[] = $this->consumoMensal([
                    'mes' => $this->mesAntes($mes),
                    'ano' => now()->year,
                    'bloco' => $bloco,
                    'unidade' => $unidade->nome,
                ]);
            }

            $consumo[$unidade->nome] = $consumo_por_meses;
            // pode ser que no primeiro e ultimo dia do mes as informações apareçam de forma incorreta por causa do calculo de data
        }

        return $consumo;
    }

    public function listaDeLeitura(Request $request)
    {
        $blocos = Agrupamento::where('imovel_id', auth()->user()->imovel_id)->orderBy('nome')->get(['nome']);

        return view('sindico.lista-de-leitura', compact('blocos'));
    }

    public function listaDeLeituraTabela(Request $request)
    {
        return Leitura::whereHas('prumada.unidade', function($query) {
                $query->where('imovel_id', auth()->user()->imovel_id);
            })->when($request->bloco, function($query, $bloco) {
                $query->whereHas('prumada.unidade.agrupamento', function($subquery) use ($bloco) {
                    $subquery->where('nome', $bloco);
                });
            })->when($request->unidade, function($query, $unidade) {
                $query->whereHas('prumada.unidade', function($subquery) use ($unidade) {
                    $subquery->where('nome', $unidade);
                });
            })->when($request->data_inicio, function($query, $data_inicio) {
                $query->whereDate('created_at', '>=', $data_inicio);
            })->when($request->data_fim, function($query, $data_fim) {
                $query->whereDate('created_at', '<=', $data_fim);
            })->orderByDesc('id')->get(['metro', 'consumo', 'created_at']);
    }

    public function unidadePorBloco($bloco)
    {
        return Unidade::where('imovel_id', auth()->user()->imovel_id)
            ->whereHas('agrupamento', function($query) use ($bloco) {
            $query->where('nome', $bloco);
        })->pluck('nome');
    }

    public function comparativoDeConsumo(Request $request)
    {
        $blocos = Agrupamento::where('imovel_id', auth()->user()->imovel_id)->orderBy('nome')->get(['nome']);

        return view('sindico.comparativo-de-consumo', compact('blocos'));
    }

    public function graficoConsumoAnual($bloco)
    {
        $unidades_total = auth()->user()->imovel->unidade()->count();

        $unidades_bloco = auth()->user()->imovel->unidade()
            ->whereHas('agrupamento', function($query) use ($bloco) {
            $query->where('nome', $bloco);
        })->count();

        for ($mes = 1; $mes <= 12; $mes++) {
            $consumo['bloco'][] =  intval($this->consumoMensal(['mes' => $mes, 'ano' => now()->year, 'bloco' => $bloco]) / $unidades_bloco);

            $consumo['total'][] =  intval($this->consumoMensal(['mes' => $mes, 'ano' => now()->year]) / $unidades_total);
        }

        return $consumo;
    }
}
