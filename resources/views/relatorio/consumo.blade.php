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

    <div class="col-md-12">
        <div class="row">
            {!! Form::open(['action' => 'RelatorioController@getConsumoLista', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

            <?php // Filtro de Pesquisa ?>
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
                                            {{ Form::select('CONSUMO_IMOVEL', $imoveis, null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}
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
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class='form-group'>
                                                {{ Form::label('PRU_ID', '#ID Hidrômetro') }}
                                                {{ Form::select('PRU_ID', ['' => 'SELECIONE O IMÓVEL PRIMEIRO'], null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class='form-group'>
                                                {{ Form::label('CONSUMO_SERIAL', 'Serial Hidrômetro') }}
                                                {{ Form::text('CONSUMO_SERIAL', '', ['class' => 'form-control', 'placeholder' => '']) }}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class='form-group'>
                                                {{ Form::label('CONSUMO_STATUS', 'Status') }}
                                                {{ Form::select('CONSUMO_STATUS', [1 => 'Ativo', 0 => 'Inativo'], null, ['class' => 'form-control']) }}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php // FIM - Pesquisa avançada ?>

                </div>
                <?php // FIM - Filtro de Pesquisa ?>

            </div>

            <?php // Botão opções ?>
            <div class="col-md-3">

                <?php // Botão Filtrar ?>
                <div class="form-group">
                    {{ Form::label('', '&nbsp;') }}
                    <button type="submit" type="button" style="width: 100% "class="btn btn-primary"><i class="fa fa-filter"></i> Filtrar</button>
                </div>

                <?php // Botão exportar ?>
                <div class="form-group">
                    <div class="box box-danger" style="margin-top: -15px;">
                        <div class="box-header with-border gray" style="background-color: #dd4b39; color: white; text-align: center;">
                            <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"></i> Exportar</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class='box-body' style="text-align: center;">
                            <button class="btn-default btn" style="margin-top: 5px; font-size: 10px;"><i class="fa fa-save"></i> CSV</button>
                        </div>
                    </div>
                </div>

            </div>

            {!! Form::close() !!}
        </div>
    </div>




    <?php // Resultados ?>
    <div class="col-md-12">

        <?php // Resultados CONSUMO COMPLETO ?>
        @if(!empty($consumos))
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
                                    <th>Imovel</th>
                                    <th># Equipamento</th>
                                    <th>Nome</th>
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
                                    <td>{{ $consumo['Imovel'] }}</td>
                                    <td>{{ $consumo['IndiceGeral'] }}</td>
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


        @foreach($consumoAvancados as $consumoAvancado)

        <p>IndiceGeral {{ $consumoAvancado['IndiceGeral'] }}</p>
        <p>LeituraAnterior {{ $consumoAvancado['LeituraAnterior'] }}</p>
        <p>LeituraAtual {{ $consumoAvancado['LeituraAtual'] }}</p>
        <p>Consumo {{ $consumoAvancado['Consumo'] }}</p>
        <p>Valor {{ $consumoAvancado['Valor'] }}</p>

        @endforeach

        <div class="row" style="margin-top: 40px; margin-bottom: 40px;">
            <div class="col-md-3">
                <div class="box box-success" style="margin-top: -15px;">
                    <div class="box-header with-border gray" style="background-color: #00a65a; color: white; text-align: center;">
                        <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"></i> Consumo de Litros - Valor</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class='box-body'>
                        <p style="text-align: center; font-weight: 600; font-size: 16px;">13m³ - R$ 245,66</p>
                    </div>
                </div><!-- /.box .box-primary -->
            </div>

            <div class="col-md-3">
                <div class="box box-warning" style="margin-top: -15px;">
                    <div class="box-header with-border gray" style="background-color: #f39c12; color: white; text-align: center;">
                        <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"></i> Cota consumo Área Comum</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class='box-body'>
                        <p style="text-align: center; font-weight: 600; font-size: 16px;">13m³ - R$ 245,66</p>
                    </div>
                </div><!-- /.box .box-primary -->
            </div>

            <div class="col-md-3">
                <div class="box box-primary" style="margin-top: -15px;">
                    <div class="box-header with-border gray" style="background-color: #3c8dbc; color: white; text-align: center;">
                        <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"></i> Valor da Água R$</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class='box-body'>
                        <p style="text-align: center; font-weight: 600; font-size: 16px;">13m³ - R$ 245,66</p>
                    </div>
                </div><!-- /.box .box-primary -->
            </div>




        </div>




        @endif
        <?php // FIM - Resultados CONSUMO AVANÇADO?>


    </div>
    <?php // FIM - Resultados ?>

</div>

@stop
