@extends('adminlte::page')

@section('title', 'MedirWeb')

@section('content_header')
<h1>Dashboard <small>Seja bem vindo</small></h1>
<ol class="breadcrumb">
    {{ date('d \d\e M \d\e Y ') }}
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">        
        <input class="form-control w-100" type="search" placeholder="Pesquise por nome, bloco, apartamento ou CPF">
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">

        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Resumo</h3>
            </div>

            <div class='box-body'>
                <div class='row'>

                    <div class="col-md-6">

                        <div class="small-box bg-teal">
                            <div class="inner">
                                <h3>{{ $unidades }}</h3>

                                <p>Unidades</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>

                    </div>

                    <div class='col-md-6'>

                        <div class="small-box bg-orange">
                            <div class="inner">
                                <h3>{{ count($prumadas) }}</h3>

                                <p>Hidrômetros</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-dashboard"></i>
                            </div>
                        </div>

                    </div>

                    <div class='col-md-6'>

                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{ $consumo_total_mensal }} <sup style="font-size:17px;top:-20px!important;">m³</sup> </h3>

                                <p>Consumo total mensal</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-cog"></i>
                            </div>
                        </div>

                    </div>

                    <div class='col-md-6'>

                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>{{ $consumo_medio_por_unidade_mensal }} <sup style="font-size:17px;top:-20px!important;">m³</sup> </h3>

                                <p>Consumo médio por unidade mensal</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-info"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
<br>
<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">Comparativo de consumo ultimos 6 meses</h3>
    </div>
    <div class="col-md-9">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Bloco</th>
                    <th>{{ $mes[now()->subMonth(5)->month] }}</th>
                    <th>{{ $mes[now()->subMonth(4)->month] }}</th>
                    <th>{{ $mes[now()->subMonth(3)->month] }}</th>
                    <th>{{ $mes[now()->subMonth(2)->month] }}</th>
                    <th>{{ $mes[now()->subMonth(1)->month] }}</th>
                    <th>{{ $mes[now()->subMonth(0)->month] }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consumo_ultimos_6meses as $bloco => $consumos)
                <tr data-bloco="{{ $bloco }}">
                    <td>{{ $bloco }}</td>
                    @foreach ($consumos as $mes => $consumo)
                        <td data-mes="{{ $mes }}" data-consumo="{{ $consumo }}" class="mes-para-comparar">{{ $consumo }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-md-3 bg-warning">
        <div class="h4">Comparativo</div>
        <div class="row" style="margin-bottom:15px;">
            <div class="col-md-6 text-center" id="bloco-e-mes0">-</div>
            <div class="col-md-6 text-center" id="consumo0">-</div>
        </div>
        <div class="row" style="margin-bottom:15px;">
            <div class="col-md-6 text-center" id="bloco-e-mes1">-</div>
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
@stop


@push('js')
<script src="/js/sindico_painel.js"></script>
<script>
    $(function() {
        var data = [];

        $.each({!! json_encode($consumo_mes, true) !!}, function(key, value) {
            data.push(value);
        })
        
        var areaChartData = {
            labels  : ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            datasets: [
                {
                    label: 'Ano corrente',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: data
                },
            ]
        }
        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)
        var temp0 = areaChartData.datasets[0]
        //var temp1 = areaChartData.datasets[1]
        
        //barChartData.datasets[0] = temp1
        barChartData.datasets[0] = temp0
        
        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
        }
        
        var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })
    })
</script>
@endpush