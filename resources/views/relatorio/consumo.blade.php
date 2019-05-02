@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1><i class="fa fa-users"></i> Relatório Consumo <small>Ver Relatório</small></h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Relatorio</a></li>
    <li class="active">Consumo</li>
</ol>
@stop

@section('content')

<div class="row">

    <?php // Filtro de Pesquisa ?>
    <div class="col-md-12">
        <div class="row">
            {!! Form::open(['action' => 'RelatorioController@getConsumoLista', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

            <div class="col-md-9">
                <div class="box box-gray">
                    <div class="box-header with-border gray">
                        <h3 class="box-title"><i class="fa fa-search"></i> Filtro de Pesquisa</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <?php // Filtro de Pesquisa  COMPLETA?>
                    <div class='box-body'>
                        <div class='row'>
                            <div class="col-md-12">
                                <div class="row">

                                    <div class='col-md-4'>
                                        <div class='form-group'>
                                            {{ Form::label('', 'Data Inicio (Anterior)') }}
                                            {{ Form::date('CONSUMO_DATA_ANTERIOR', date("Y-m-d", strtotime('-1 month')), ['class'=>'form-control', 'placeholder' => '']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class='form-group'>
                                            {{ Form::label('', 'Data Final (Atual)') }}
                                            {{ Form::date('CONSUMO_DATA_ATUAL', date("Y-m-d"), ['class'=>'form-control', 'placeholder' => '']) }}
                                        </div>
                                    </div>

                                    <div class='col-md-4'>
                                        <div class='form-group'>
                                            {{ Form::label('', 'Imóvel') }}
                                            {{ Form::select('RELATORIO_IMOVEL', $imoveis, null, ['class' => 'avalidate form-control chosen-select-IMO_IDESTADO', 'autocomplete' => 'off']) }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php // FIM - Filtro de Pesquisa  COMPLETA?>

                    <?php // Pesquisa avançada ?>
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-search-plus"></i> Pesquisa avançada</h3>
                        </div>
                        <div class='box-body'>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class='form-group'>
                                        {{ Form::label('UNI_ID', '# Apartamento') }}
                                        {{ Form::select('UNI_ID', ['' => 'SELECIONE O IMÓVEL PRIMEIRO'], null, ['class' => 'avalidate form-control chosen-select-apartamento', 'autocomplete' => 'off']) }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php // FIM - Pesquisa avançada ?>

                </div>
            </div>

            <?php // Botão opções ?>
            <div class="col-md-3">

                <?php // Botão Filtrar ?>
                <div class="form-group">
                    {{ Form::label('', '&nbsp;') }}
                    <button type="submit" type="button" name="filtrar" value="filtrar" style="width: 100% "class="btn btn-primary"><i class="fa fa-filter"></i> Filtrar</button>
                </div>

                <?php // Botão exportar ?>
                <div class="form-group">
                    <div class="box box-danger">
                        <div class="box-header with-border gray" style="background-color: #dd4b39; color: white; text-align: center;">
                            <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"></i> Exportar</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class='box-body' style="text-align: center;">
                            <button type="submit" type="button" name="export" value="excel" class="btn-default btn" style="margin-top: 5px; font-size: 10px;"><i class="fa fa-save"></i> CSV</button>
                        </div>
                    </div>
                </div>

            </div>

            {!! Form::close() !!}
        </div>
    </div>
    <?php // FIM - Filtro de Pesquisa ?>

    <?php // Resultados ?>
    <div class="col-md-12">

        <?php // Resultados CONSUMO COMPLETO ?>
        @if(!empty($consumos))

        <?php // GRAFICO ?>
        <div class="form-group">
            <div class="box box-primary collapse-box">
                <div class="box-header with-border gray" style="background-color: #3c8dbc; color: white; text-align: center;">
                    <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"></i> GRAFICOS</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class='box-body' style="text-align: center;">

                    <?php // GRAFICO CONSUMO POR APARTAMENTO (TYPE: PIZZA) ?>
                    <div class="col-md-3 text-center">
                        {!! $chartConsumoPizza->container() !!}
                        {!! $chartConsumoPizza->script() !!}
                    </div>
                    <?php // FIM - GRAFICO CONSUMO POR APARTAMENTO (TYPE: PIZZA) ?>

                    <?php // GRAFICO CONSUMO POR APARTAMENTO (TYPE: LINE) ?>
                    <div class="col-md-9">
                        {!! $chartConsumoLine->container() !!}
                        {!! $chartConsumoLine->script() !!}
                    </div>
                    <?php // FIM - GRAFICO CONSUMO POR APARTAMENTO (TYPE: LINE) ?>

                </div>
            </div>
        </div>
        <?php // FIM - GRAFICO ?>

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Resultados da Pesquisa </h3>
            </div>
            <div class="box-body">
                <div class"row">
                    <div class="col-md-12">
                        <table id="lista-clientes" class="table table-responsive table-bordered table-hover powertabela">
                            <thead>
                                <tr>
                                    <th>#EQP</th>
                                    <th>Nome EQP</th>
                                    <th>Nome Responsável</th>
                                    <th>Apartamento</th>
                                    <th>Leitura Anterior</th>
                                    <th>Leitura Atual</th>
                                    <th>Consumo m³</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody >
                                @foreach ($consumos as $consumo)
                                <tr>
                                    <td>{{ $consumo['PRU_ID'] }}</td>
                                    <td>{{ $consumo['PRU_NOME'] }}</td>
                                    <td>{{ $consumo['Nomes'] }}</td>
                                    <td>{{ $consumo['Apartamentos'] }}</td>
                                    <td>{{ $consumo['LeituraAnterior'] }}</td>
                                    <td>{{ $consumo['LeituraAtual'] }}</td>
                                    <td>{{ $consumo['Consumo'] }}</td>
                                    <td>{{ $consumo['Valor'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <?php // FIM Resultados CONSUMO COMPLETO ?>

        <?php // Resultados CONSUMO AVAÇADO ?>
        @if(!empty($consumoAvancados))

        <div class="row" style="margin-top: 40px; margin-bottom: 40px;">
            <div class="col-md-12">
                <div class="row">

                    <div class="col-md-3">
                        <div class="box box-success" style="margin-top: -15px;">
                            <div class="box-header with-border gray" style="background-color: #00a65a; color: white; text-align: center;">
                                <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;">Leitura Anterior</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class='box-body'>
                                @foreach($consumoAvancados as $consumoAvancado)
                                <hr style="margin-bottom: -1px; margin-top: -10px;">
                                <small><i class="fa fa-tachometer"></i> #{{ $consumoAvancado['PRU_ID'] }} - {{ $consumoAvancado['PRU_NOME'] }}</small>
                                <div style="text-align:right; bottom:15px; position: relative;">
                                    <small>{{ $consumoAvancado['DataLeituraAnterior'] }} <i class="fa fa-calendar"></i></small>
                                </div>
                                <hr style="margin-top: -10px;">
                                <p style="text-align: center; font-weight: 600; font-size: 18px; margin-bottom: 20px;" > {{ $consumoAvancado['LeituraAnterior'] }}m³</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="box box-warning" style="margin-top: -15px;">
                            <div class="box-header with-border gray" style="background-color: #f39c12; color: white; text-align: center;">
                                <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;">Leitura Atual</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class='box-body'>
                                @foreach($consumoAvancados as $consumoAvancado)
                                <hr style="margin-bottom: -1px; margin-top: -10px;">
                                <small><i class="fa fa-tachometer"></i> #{{ $consumoAvancado['PRU_ID'] }} - {{ $consumoAvancado['PRU_NOME'] }}</small>
                                <div style="text-align:right; bottom:15px; position: relative;">
                                    <small>{{ $consumoAvancado['DataLeituraAtual'] }} <i class="fa fa-calendar"></i></small>
                                </div>
                                <hr style="margin-top: -10px;">
                                <p style="text-align: center; font-weight: 600; font-size: 18px; margin-bottom: 20px;" > {{ $consumoAvancado['LeituraAtual'] }}m³</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="box box-primary" style="margin-top: -15px;">
                            <div class="box-header with-border gray" style="background-color: #3c8dbc; color: white; text-align: center;">
                                <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"></i> Valor Total R$</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class='box-body'>
                                @foreach($consumoAvancados as $consumoAvancado)
                                <hr style="margin-bottom: -1px; margin-top: -10px;">
                                <small><i class="fa fa-tachometer"></i> #{{ $consumoAvancado['PRU_ID'] }} - {{ $consumoAvancado['PRU_NOME'] }}</small>
                                <hr style="margin-top: 5px;">
                                <p style="text-align: center; font-weight: 600; font-size: 18px; margin-bottom: 20px;" > {{ $consumoAvancado['Consumo'] }}m³ - R$ {{ $consumoAvancado['Valor'] }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php // GRAFICO ?>
            <div class="col-md-12">

                <div class="form-group">
                    <div class="box box-primary collapse-box">
                        <div class="box-header with-border gray" style="background-color: #3c8dbc; color: white; text-align: center;">
                            <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"></i> GRAFICO</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class='box-body' style="text-align: center;">
                            <div class="col-md-12">
                                {!! $chartConsumoLine->container() !!}
                                {!! $chartConsumoLine->script() !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php // FIM - GRAFICO ?>

        </div>
        @endif
        <?php // FIM - Resultados CONSUMO AVANÇADO?>

    </div>
    <?php // FIM - Resultados ?>

</div>

@stop
