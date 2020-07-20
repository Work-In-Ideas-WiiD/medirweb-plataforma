@extends('adminlte::page')

@section('title', 'MedirWeb')

@section('content_header')
<h1>Dashboard <small>Seja bem vindo</small></h1>
<ol class="breadcrumb">
    {{ date('d \d\e M \d\e Y ') }}
</ol>
@stop

@section('content')

<style>
    .circulos {
        padding-top: 15%;
        margin: auto;
        background: #3c8dbc;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        font-size:25px;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <input class="form-control w-100" type="search" placeholder="Pesquise por nome, bloco, apartamento ou CPF">
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        AA
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-6">
                <div class="bg-info">A</div>
            </div>
            <div class="col-md-6">
                <div class="bg-info">B</div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="row text-center">
            <div class="col-md-3">
                <div class="bg-info">
                    neste ano
                    <div class="circulos">{{ $media_mensal }}</div>
                    média mensal
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-info">
                    neste ano
                    <div class="circulos">{{ $total_ano }}</div>
                    consumo total
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-info">
                    neste mês
                    <div class="circulos">{{ $este_mes }}</div>
                    consumo total
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-info">
                    neste mês
                    <div class="circulos">{{ $media_unidades }}</div>
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
                <h3 class="card-title text-center">Comparativo de consumo</h3>

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
                <tr>
                    <td>{{ $mes }}</td>
                    <td>{{ $info['media_consumo_por_unidade'] }} m<sup>3</sup></td>
                    <td>{{ $info['media_consumo_por_bloco'] }} m<sup>3</sup></td>
                    <td>{{ $info['consumo_total'] }} m<sup>3</sup></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-md-3 bg-warning">
        <div class="h4">Comparativo</div>
        <div class="row" style="margin-bottom:15px;">
            <div class="col-md-6 text-center" id="unidade-e-mes0">-</div>
            <div class="col-md-6 text-center" id="consumo0">-</div>
        </div>
        <div class="row" style="margin-bottom:15px;">
            <div class="col-md-6 text-center" id="unidade-e-mes1">-</div>
            <div class="col-md-6 text-center" id="consumo1">-</div>
        </div>
        <div class="row" style="margin-bottom:15px;">
            <div class="col-md-6">
                <div class="text-center" style="background:#ff0047;" id="diferenca-consumo">-</div>
            </div>
            <div class="col-md-6">
                <div class="text-center" style="background:#ff0047;" id="diferenca-porcentagem">-</div>
            </div>
            
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
                    <td>{{ $leitura->created_at->format('d/m/Y i:s') }}</td>
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