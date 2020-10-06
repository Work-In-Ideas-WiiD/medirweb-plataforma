@extends('adminlte::page')

@section('title', 'MedirWeb')

@section('content_header')
<!-- <h1>Dashboard <small>Seja bem vindo</small></h1>
<ol class="breadcrumb">
    {{ date('d \d\e M \d\e Y ') }}
</ol> -->
@stop

{!! Html::style( asset('css/comparativo.css')) !!}
{!! Html::style( asset('css/total.css')) !!}

@section('content')

<style>
    .circulos {
        
        background: #2c2f36;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        font-size: 2em;
        align-items: center;
        display: flex;
        justify-content: center;
        color: #fff;
        font-weight: 100;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <input class="form-control w-100 pesquisar" type="search" placeholder="Pesquise por nome, bloco, apartamento ou CPF">
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <h3 class="tituloBloco">Bloco {{ $bloco }} <label>Unidade {{ $unidade }}</label></h3>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-6">
                <div class="bg-info blocoAB">A</div>
            </div>
            <div class="col-md-6">
                <div class="bg-info blocoAB">B</div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="row text-center blocoCirculos">
            <div class="col-md-3 col-lg-2  col-sm-6">
                <div class="bg-info antesCirculo">
                    neste ano
                    <div class="circulos1">
                        <div class="circulos ">{{ $media_mensal }}</div>
                    </div>
                    média mensal
                </div>
            </div>
            <div class="col-md-3 col-lg-2 col-lg-offset-1 col-sm-6">
                <div class="bg-info antesCirculo">
                    neste ano
                    <div class="circulos2">
                        <div class="circulos">{{ $total_ano }}</div>
                    </div>
                    consumo total
                </div>
            </div>
            <div class="col-md-3 col-lg-2 col-lg-offset-1 col-sm-6">
                <div class="bg-info antesCirculo">
                    neste mês
                    <div class="circulos3">
                        <div class="circulos ">{{ $este_mes }}</div>
                    </div>
                    consumo total
                </div>
            </div>
            <div class="col-md-3 col-lg-2 col-lg-offset-1 col-sm-6">
                <div class="bg-info antesCirculo">
                    neste mês
                    <div class="circulos4">
                        <div class="circulos ">{{ $media_unidades }}</div>
                    </div>
                    média de consumo do condomínio
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title text-center tituloCentral">Comparativo de consumo</h3>

                <!--div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button>
                </div-->
                </div>
                <div class="card-body">
                <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-9">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Média consumo unidade</th>
                    <th>Média consumo bloco</th>
                    <th>Consumo total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consumo as $mes => $info)
                <tr data-mes="{{ substr($mes, 0, 3) }}" data-consumo="{{ $info['consumo_total'] }}" class="mes-para-comparar">
                    <td>{{ $mes }}</td>
                    <td><div data-toggle="tooltip" title="Clique aqui para comparar">{{ $info['media_consumo_por_unidade'] }} m<sup>3</sup></div></td>
                    <td><div data-toggle="tooltip" title="Clique aqui para comparar">{{ $info['media_consumo_por_bloco'] }} m<sup>3</sup></div></td>
                    <td><div data-toggle="tooltip" title="Clique aqui para comparar">{{ $info['consumo_total'] }} m<sup>3</sup></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-md-3 bg-warning quadroComp">
        <div class="h4 tituloComp">Comparativo</div>
        <h2 class="expComp">Clique nas medições da tabela para comparar</h2>
        <div class="row" style="margin-bottom:15px;">
            <div class="col-md-6 text-center" id="unidade-e-mes0">-</div>
            <div class="col-md-6 text-center" id="consumo0">-</div>
        </div>
        <div class="row" style="margin-bottom:15px;">
            <div class="col-md-6 text-center" id="unidade-e-mes1">-</div>
            <div class="col-md-6 text-center" id="consumo1">-</div>
        </div>
        <div class="row" style="margin-bottom:15px;">
            <div class="col-md-6 blocoResultado">
                <div class="text-center" style="background:#ff0047;" id="diferenca-consumo">-</div>
            </div>
            <div class="col-md-6 blocoResultado">
                <div class="text-center" style="background:#ff0047;" id="diferenca-porcentagem">-</div>
            </div>
            
        </div>
    </div>
    <div style="margin: 0 auto; display: table;">
        <div class="icon iconeFuncao">
            <i class="fa fa-file-o"></i>
        </div>
        <div class="icon iconeFuncao2 para-ir" data-para-ir="#link-aqui">
            <i class="fa fa-file-excel-o"></i>
        </div>
        <div class="icon iconeFuncao3">
            <i class="fa fa-print"></i>
        </div>
    </div>
    
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Leitura acumulada</th>
                    <th>Consumo acumulado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leituras as $leitura)
                <tr>
                    <td>{{ $leitura->created_at }}</td>
                    <td>{{ $leitura->metro }}m <sup>3</sup></td>
                    <td>{{ $leitura->consumo }}m <sup>3</sup></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop


@push('js')
<script src="/js/sindico_busca.js"></script>
<script src="/js/sindico_unidade_comparativo_de_consumo.js"></script>
<script src="/js/sindico_grafico.js"></script>

<script>
    $(function() {
        let data = []

        $.each({!! json_encode($grafico) !!}, function(key, value) {
            data.push(value)
        })

        criarGrafico({data: data, title: 'Comparativo de consumo'})        
    })
</script>
@endpush