@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1><i class="fa fa-users"></i> Liquidação de Faturas <small>Ver Relatório</small></h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Relatorio</a></li>
    <li class="active">Fatura</li>
</ol>
@stop

@section('content')

<div class="row">
    {!! Form::open(['action' => 'RelatorioController@getFaturaLista', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <?php // Filtro de Pesquisa ?>
    <div class="col-md-12">
        <div class="row">

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
                                            {{ Form::date('FATURA_DATA_ANTERIOR', date("Y-m-d", strtotime('-1 month')), ['class'=>'form-control', 'placeholder' => '']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class='form-group'>
                                            {{ Form::label('', 'Data Final (Atual)') }}
                                            {{ Form::date('FATURA_DATA_ATUAL', date("Y-m-d"), ['class'=>'form-control', 'placeholder' => '']) }}
                                        </div>
                                    </div>

                                    <div class='col-md-4'>
                                        <div class='form-group'>
                                            {{ Form::label('', 'Imóvel') }}
                                            {{ Form::select('RELATORIO_IMOVEL', $imoveis, null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}
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

            </div>

        </div>
    </div>
    <?php // FIM - Filtro de Pesquisa ?>

    <?php // Resultados ?>
    <div class="col-md-12">

        <?php // Resultados FATURA COMPLETO ?>
        @if(!empty($faturas))

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Resultados da Pesquisa </h3>
            </div>
            <div class="box-body">
                <div class"row">
                    <div class="col-md-12">
                        <table id="lista-clientes" class="table table-bordered table-hover powertabela">
                            <thead>
                                <tr>
                                    <th>Nome Responsável</th>
                                    <th>Apartamento</th>
                                    <th>Nome EQP</th>
                                    <th>Leitura Anterior</th>
                                    <th>Leitura Atual</th>
                                    <th>Consumo m³</th>
                                    <th>Valor</th>
                                    <th>Fatura</th>
                                </tr>
                            </thead>
                            <tbody >
                                @foreach ($faturas as $fatura)
                                <tr>
                                    <td>{{ $fatura['responsavelAp'] }}</td>
                                    <td>{{ $fatura['nomeAp'] }}</td>
                                    <td>{{ $fatura['PRU_NOME'] }}</td>
                                    <td>{{ $fatura['LeituraAnterior'] }}</td>
                                    <td>{{ $fatura['LeituraAtual'] }}</td>
                                    <td>{{ $fatura['Consumo'] }}</td>
                                    <td>{{ $fatura['Valor'] }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="submit" type="button" name="pdf" value="{{ $fatura['UNI_ID'] }}" class="btn btn-danger btn-flat"><i class="fa fa-file-pdf-o"></i> PDF</button>
                                            {{ Form::text('DataAnteriorForm', $fatura['DataAnteriorForm'], ['style' => 'display:none']) }}
                                            {{ Form::text('DataAtualForm', $fatura['DataAtualForm'], ['style' => 'display:none']) }}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <?php // FIM Resultados FATURA COMPLETO ?>

        <?php // Resultados FATURA AVAÇADO ?>
        @if(!empty($faturaAvancados))

        <div class="row" style="margin-top: 40px; margin-bottom: 40px;">

            <div class="col-md-12">
                <div class="row">

                    <?php // Leitura Anterior?>
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
                                @foreach($faturaAvancados as $faturaAvancado)
                                <hr style="margin-bottom: -1px; margin-top: -10px;">
                                <small><i class="fa fa-tachometer"></i> #{{ $faturaAvancado['PRU_ID'] }} - {{ $faturaAvancado['PRU_NOME'] }}</small>
                                <div style="text-align:right; bottom:15px; position: relative;">
                                    <small>{{ $faturaAvancado['DataLeituraAnterior'] }} <i class="fa fa-calendar"></i></small>
                                </div>
                                <hr style="margin-top: -10px;">
                                <p style="text-align: center; font-weight: 600; font-size: 18px; margin-bottom: 20px;" > {{ $faturaAvancado['LeituraAnterior'] }}m³</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <?php // FIM - Leitura Anterior?>

                    <?php // Leitura Atual?>
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
                                @foreach($faturaAvancados as $faturaAvancado)
                                <hr style="margin-bottom: -1px; margin-top: -10px;">
                                <small><i class="fa fa-tachometer"></i> #{{ $faturaAvancado['PRU_ID'] }} - {{ $faturaAvancado['PRU_NOME'] }}</small>
                                <div style="text-align:right; bottom:15px; position: relative;">
                                    <small>{{ $faturaAvancado['DataLeituraAtual'] }} <i class="fa fa-calendar"></i></small>
                                </div>
                                <hr style="margin-top: -10px;">
                                <p style="text-align: center; font-weight: 600; font-size: 18px; margin-bottom: 20px;" > {{ $faturaAvancado['LeituraAtual'] }}m³</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <?php // FIM - Leitura Atual?>

                    <?php // Valor Total e exportar PDF individual ?>
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
                                @foreach($faturaAvancados as $faturaAvancado)
                                <hr style="margin-bottom: -1px; margin-top: -10px;">
                                <small><i class="fa fa-tachometer"></i> #{{ $faturaAvancado['PRU_ID'] }} - {{ $faturaAvancado['PRU_NOME'] }}</small>
                                <hr style="margin-top: 5px;">
                                <p style="text-align: center; font-weight: 600; font-size: 18px; margin-bottom: 20px;" > {{ $faturaAvancado['Consumo'] }}m³ - R$ {{ $faturaAvancado['Valor'] }}</p>

                                <?php // Dados para exportar (ID, DATA ATUAL E ANTERIOR)
                                $ID_AP =  $faturaAvancado['UNI_ID'];?>
                                {{ Form::text('DataAnteriorForm', $faturaAvancado['DataAnteriorForm'], ['style' => 'display:none']) }}
                                {{ Form::text('DataAtualForm', $faturaAvancado['DataAtualForm'], ['style' => 'display:none']) }}
                                @endforeach
                                <div style="text-align: center;">
                                    <hr>
                                    <button type="submit" type="button" name="pdf" value="{{ $ID_AP }}" class="btn-danger btn" style="text-align: center; font-weight: 600; font-size: 16px;"><i class="fa fa-file-pdf-o"></i> Gerar Fatura</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php // FIM - Valor Total e exportar PDF individual ?>

                </div>
            </div>

        </div>
        @endif
        <?php // FIM - Resultados FATURA AVANÇADO?>

    </div>
    <?php // FIM - Resultados ?>

    {!! Form::close() !!}
</div>

@stop
