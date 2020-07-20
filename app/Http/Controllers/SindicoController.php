<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agrupamento;
use App\Models\Prumada;
use App\Models\Leitura;
use App\Models\Unidade;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CosumoExport;
use App\Exports\CosumoGraficoExport;
use App\Exports\CosumoGraficoMediaExport;

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
        return somar_consumo($array);
    }

    private function mesAntes($mes, $ano = null)
    {
        if (!$ano) {
            $ano = now()->year;
        }

        $data = now()->year($ano)->subMonth($mes);

        if (now()->day == 30) {
            $data = now()->year($ano)->subMonth($mes)->subDay(1);
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
                    'ano' => now()->year,
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

        $meses = $this->mes;

        return view('sindico.consumo-por-unidade', compact('blocos', 'meses'));
    }

    public function consumoPorBlocoEUnidade(Request $request, $bloco, $primeiro_mes, $ultimo_mes)
    {
        if ($bloco == 'bloco' or $request->ano == 'ano') {
            return [];
        }

        $unidades = Unidade::with('agrupamento')->where('imovel_id', auth()->user()->imovel_id)
            ->whereHas('agrupamento', function($query) use ($bloco) {
                $query->where('nome', $bloco);
        })->get();

        foreach ($unidades as $unidade) {
            $consumo_por_meses = [];

            foreach (range($primeiro_mes, $ultimo_mes) as $mes) {
                $consumo_por_meses[] = $this->consumoMensal([
                    'mes' => $mes + 1,
                    'ano' => $request->ano,
                    'bloco' => $bloco,
                    'unidade' => $unidade->nome,
                ]);
            }

            $consumo[$unidade->nome] = $consumo_por_meses;
            // pode ser que no primeiro e ultimo dia do mes as informações apareçam de forma incorreta por causa do calculo de data
        }

        return $consumo;
    }

    public function consumoPorBlocoEUnidadeDiario(Request $request, $bloco)
    {
        if ($bloco == 'bloco' or $request->ano == 'ano' or $request->mes == 'mes') {
            return [];
        }

        $unidades = Unidade::with('agrupamento')->where('imovel_id', auth()->user()->imovel_id)
            ->whereHas('agrupamento', function($query) use ($bloco) {
                $query->where('nome', $bloco);
        })->get();

        foreach ($unidades as $unidade) {
            $consumo_por_dias = [];

            foreach (range(1, now()->month($request->mes)->daysInMonth) as $dia) {
                $consumo_por_dias[] = $this->consumoMensal([
                    'dia' => $dia,
                    'mes' => $request->mes,
                    'ano' => $request->ano,
                    'bloco' => $bloco,
                    'unidade' => $unidade->nome,
                ]);
            }

            $consumo[$unidade->nome] = $consumo_por_dias;
            // pode ser que no primeiro e ultimo dia do mes as informações apareçam de forma incorreta por causa do calculo de data
        }

        return [
            'dias' => range(1, now()->month($request->mes)->daysInMonth),
            'consumo' => $consumo,
        ];
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

        $meses = $this->mes;

        return view('sindico.comparativo-de-consumo', compact('blocos', 'meses'));
    }

    public function comparativoDeConsumoMensal(Request $request)
    {
        $consumo = [];
        $unidade = null;

        if ($request->bloco == 'bloco' or $request->mes == 'mes' or $request->ano == 'ano') {
            return [];
        }

        if (!empty($request->unidade) and $request->unidade != 'unidade') {
            $unidade = $request->unidade;
        }

        $unidades = auth()->user()->imovel->unidade()
            ->when($unidade, function($query, $unidade) {
            $query->where('nome', $unidade);
        })->get(['id', 'nome']);

        foreach ($unidades as $unidade) {

            foreach($request->mes == 1 ? range(1, 6) : range(7, 12) as $mes) {
                
                $query = Leitura::whereHas('prumada.unidade', function($query) use ($request, $unidade) {
                    $query->where('id', $unidade->id);
                    $query->where('imovel_id', auth()->user()->imovel_id);
                    $query->whereHas('agrupamento', function($subquery) use ($request){
                        $subquery->where('nome', $request->bloco);
                    });
                })
                ->whereYear('created_at', $request->ano)
                ->whereMonth('created_at', $mes)
                ->select('metro', 'consumo');

                $consumo[$unidade->nome][$mes] = [
                    'inicio' => $query->first()->metro ?? 0,
                    'fim' =>  $query->orderByDesc('id')->first()->metro ?? 0,
                    'consumo' => $query->sum('consumo') ?? 0,
                ];
            }

        }

        return $consumo;
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

    // EXPORT TABLES

    public function exportUltimosPorBlocoSeisMeses()
    {
        $consumo = $this->ultimosPorBlocoMeses(0, 5);

        return Excel::download(new CosumoExport(auth()->user()->imovel_id, $consumo, 'Bloco', 6), 'cosumo_export.xlsx');
    }

    public function exportGraficoCosumo()
    {
        for ($mes = 1; $mes <= 12; $mes++) {
            $consumo_mes[$mes] = $this->consumoMensal(['mes' => $mes, 'ano' => now()->year]);
        }

        return Excel::download(new CosumoGraficoExport(auth()->user()->imovel_id, $consumo_mes), 'cosumo_grafico_export.xlsx');
    }

    public function exportUltimosPorUnidadeSeisMeses(Request $request, $bloco, $primeiro_mes, $ultimo_mes)
    {
        $consumo = $this->consumoPorBlocoEUnidade($request, $bloco, $primeiro_mes, $ultimo_mes);

        return Excel::download(new CosumoExport(auth()->user()->imovel_id, $consumo, 'Unidade', 6), 'cosumo_export_bloco.xlsx');
    }

    public function exportGraficoCosumoMedia($bloco)
    {
        $consumo = $this->graficoConsumoAnual($bloco);

        return Excel::download(new CosumoGraficoMediaExport(auth()->user()->imovel_id, $consumo), 'cosumo_grafico_export_media.xlsx');
    }    

    public function exportMensalPorUnidadeAno(Request $request, $bloco, $primeiro_mes, $ultimo_mes)
    {
        $consumo = $this->consumoPorBlocoEUnidade($request, $bloco, $primeiro_mes, $ultimo_mes);

        return Excel::download(new CosumoExport(auth()->user()->imovel_id, $consumo, 'Unidade', 12), 'cosumo_export_mensal.xlsx');
    }
    
    public function dadosUnidade(Request $request)
    {
        return auth()->user()->imovel->unidade()
            ->where('nome', $request->unidade)
            ->whereHas('agrupamento', function($query) use ($request) {
                $query->where('nome', $request->bloco);
            })->first();
    }

    public function unidadeModalGrafico($bloco, $unidade)
    {
        foreach (range(1, 12) as $mes) {
            $consumo[$mes] = $this->consumoMensal([
                'mes' => $mes,
                'unidade' => $unidade,
                'bloco' => $bloco,
            ]);
        }

        return $consumo;
    }

    public function unidadeModalMediaAnual($bloco, $unidade)
    {
        return $this->consumoMensal([
            'bloco' => $bloco,
            'unidade' => $unidade,
        ]);
    }

    public function unidadeModalEsteMes($bloco, $unidade)
    {
        return $this->consumoMensal([
            'bloco' => $bloco,
            'unidade' => $unidade,
            'mes' => now()->month,
        ]);
    }

    public function unidadeComparativoDeConsumo($bloco, $unidade)
    {
        $unidades = auth()->user()->imovel->unidade()->count();

        $unidades_bloco = auth()->user()->imovel->unidade()->whereHas('agrupamento', function($query)use ($bloco) {
            $query->where('nome', $bloco);
        })->count();

        $blocos = Agrupamento::whereHas('unidade', function($query) {
            $query->where('imovel_id', auth()->user()->imovel_id);
        })->count();

        $meses = $this->mes;

        foreach (range(1, 12) as $mes) {
            $grafico[] = somar_consumo([
                'mes' => $mes,
                'bloco' => $bloco,
                'unidade' => $unidade,
            ]);

            $consumo_total = somar_consumo(['mes' => $mes]);

            $consumo[$this->mes[$mes]] = [
                'media_consumo_por_unidade' => intval(somar_consumo([
                        'mes' => $mes,
                        'bloco' => $bloco,
                    ]) / $unidades_bloco),
                'media_consumo_por_bloco' => intval($consumo_total / $blocos),
                'consumo_total' => $consumo_total,
            ];
        }

        $total_ano = array_sum($grafico);

        $media_mensal = intval($total_ano / 12);

        $este_mes = $grafico[now()->month - 1];

        $media_unidades = intval(somar_consumo([
            'mes' => now()->month,
        ]) / $unidades);

        $leituras = Leitura::whereHas('prumada.unidade', function($query) use ($bloco, $unidade) {
            $query->where('imovel_id', auth()->user()->imovel_id);
            $query->where('nome', $unidade);
            $query->whereHas('agrupamento', function($subquery) use ($bloco) {
                $subquery->where('nome', $bloco);
            });
        })->limit(10)->orderByDesc('id')->get();

        return view('sindico.unidade-comparativo-de-consumo', compact(
            'bloco',
            'unidade',
            'meses',
            'grafico',
            'total_ano',
            'este_mes',
            'media_mensal',
            'media_unidades',
            'consumo',
            'leituras',
        ));
    }

}
