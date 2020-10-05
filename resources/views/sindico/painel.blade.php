@extends('adminlte::page')

@section('title', 'MedirWeb')

@section('content_header')
<!-- <h1>Dashboard <small>Seja bem vindo</small></h1> -->

@stop

{!! Html::style( asset('css/painel.css')) !!}
{!! Html::style( asset('css/total.css')) !!}


@section('content')
<div class="row">
    <div class="col-md-12">        
        <input class="form-control w-100 pesquisar" type="search" placeholder="Pesquise por nome, bloco, apartamento ou CPF">
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">

        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title titulo">Painel</h3>
                <ol class="breadcrumb dataPainel">
                    {{ date('d \d\e M \d\e Y ') }}
                </ol>
            </div>

            <div class='box-body'>
                <div class='row'>

                    <div class="col-md-6">

                        <div class="small-box bloco1">
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

                        <div class="small-box bloco2">
                            <div class="inner">
                                <h3>{{ $prumadas }}</h3>

                                <p>Hidrômetros</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-dashboard"></i>
                            </div>
                        </div>

                    </div>

                    <div class='col-md-6'>

                        <div class="small-box bloco3">
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

                        <div class="small-box bloco4">
                            <div class="inner">
                                <h3>{{ $consumo_medio_por_unidade_mensal }} <sup style="font-size:17px;top:-20px!important;">m³</sup> </h3>

                                <p>Consumo médio por unidade/mês</p>
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
            <h3 class="card-title text-center tituloCentral">Comparativo de consumo
                <div class="icon iconeFuncao">
                    <i class="fa fa-file-o"></i>
                </div>
                <div class="icon iconeFuncao2 para-ir" data-para-ir="{{ route('sindico.export.consumo-grafico') }}">
                    <i class="fa fa-file-excel-o"></i>
                </div>
                <div class="icon iconeFuncao3">
                    <i class="fa fa-print"></i>
                </div>
            </h3>
            

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
        <h3 class="text-center tituloCentral">Comparativo de consumo<div class="icon iconeFuncao">
                    <i class="fa fa-file-o"></i>
                </div>
                <div class="icon iconeFuncao2 para-ir" data-para-ir="{{ route('sindico.export.consumo-ultimo-seis-meses') }}">
                    <i class="fa fa-file-excel-o"></i>
                </div>
                <div class="icon iconeFuncao3">
                    <i class="fa fa-print"></i>
                </div>
            </h3>
        <h3 class="text-center tituloCentralSub">nos ultimos 6 meses</h3>
    </div>
    <div class="col-md-9">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    @if(now()->day == 30)
                        <th>{{ $mes[now()->subMonth(5)->subDay(1)->month] }}</th>
                    @else
                        <th>{{ $mes[now()->subMonth(5)->month] }}</th>
                    @endif
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
                    <td>B{{ $bloco }}</td>
                    @foreach ($consumos as $mes => $consumo)
                        <td data-mes="{{ $mes }}" data-consumo="{{ $consumo }}" class="mes-para-comparar">{{ $consumo }}m³</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-md-3 quadroComp">
        <div class="h4 tituloComp">Comparativo</div>
        <div class="row" style="margin-bottom:15px;">
            <div class="col-md-6 text-center" id="bloco-e-mes0">-</div>
            <div class="col-md-6 text-center" id="consumo0">-</div>
        </div>
        <div class="row" style="margin-bottom:15px;">
            <div class="col-md-6 text-center" id="bloco-e-mes1">-</div>
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
</div>
@stop


@push('js')
<script src="/js/sindico_busca.js"></script>
<script src="/js/sindico_painel.js"></script>
<script>
    $(function() {
        var data = [];

        $.each({!! json_encode($consumo_mes, true) !!}, function(key, value) {
            data.push(value);
        })
        
        var areaChartData = {
            labels  : ['JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ'],
            datasets: [
                {
                    label: 'no ano corrente',
                    backgroundColor: '#fbc604',
                    borderColor: '#fbc604',
                    pointRadius: true,
                    pointColor: '#fbc604',
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