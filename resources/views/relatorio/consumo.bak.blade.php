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

<?php // Filtro de Pesquisa ?>
<div class="box box-gray">
    <div class="box-header with-border gray">
        <h3 class="box-title"><i class="fa fa-search"></i> Filtro de Pesquisa</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>

    <div class='box-body'>
        <div class='row'>

            <div class="col-md-12">
                <div class="row">

                    <div class='col-md-6'>

                        <div class='form-group'>
                            {{ Form::label('CLI_DOCUMENTO', 'Data Inicio') }}
                            {{ Form::date('CLI_DATANASC', '', ['class'=>'form-control', 'placeholder' => '']) }}
                        </div>

                        <div class='form-group'>
                            {{ Form::label('PRU_IDIMOVEL', 'Imóvel') }}
                            {{ Form::select('PRU_IDIMOVEL', $imoveis, null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}
                        </div>


                    </div>

                    <div class='col-md-6'>

                        <div class='form-group'>
                            {{ Form::label('CLI_LOGRADOURO', 'Data Final') }}
                            {{ Form::date('CLI_DATANASC', '', ['class'=>'form-control', 'placeholder' => '']) }}
                        </div>

                        <?php // Botão Filtrar ?>
						<div class="form-group">
							{{ Form::label('', '&nbsp;') }}
							{{ Form::button('<i class="fa fa-filter"></i> Filtrar', ['class' => 'btn btn-default', 'style' => 'width: 100%;', 'id' => 'submitFiltroTimeline']) }}
						</div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div><!-- /.box .box-primary -->
<?php // FIM - Filtro de Pesquisa ?>

<?php // Pesquisa avançada ?>
<div class="box box-warning collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-search-plus"></i> Pesquisa avançada</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
        </div>
    </div>

    <div class='box-body'>
        <div class="row">


            <div class="col-md-12">
                <div class="row">

                    <div class='col-md-6'>
                        <div class="row">

                            <div class="col-md-6">
                                <div class='form-group'>
                                    {{ Form::label('CLI_DOCUMENTO', '#ID Hidrômetro') }}
                                    {{ Form::text('CLI_DOCUMENTO', '', ['class' => 'form-control', 'placeholder' => '']) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class='form-group'>
                                    {{ Form::label('CLI_DOCUMENTO', 'Serial Hidrômetro') }}
                                    {{ Form::text('CLI_DOCUMENTO', '', ['class' => 'form-control', 'placeholder' => '']) }}
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class='col-md-6'>
                        <div class="row">

                            <div class="col-md-6">
                                <div class='form-group'>
                                    {{ Form::label('CLI_DOCUMENTO', 'Status') }}
                                    {{ Form::text('CLI_DOCUMENTO', '', ['class' => 'form-control', 'placeholder' => '']) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <?php // Botão Filtrar ?>
        						<div class="form-group">
        							{{ Form::label('', '&nbsp;') }}
        							{{ Form::button('<i class="fa fa-filter"></i> Filtrar', ['class' => 'btn btn-default', 'style' => 'width: 100%;', 'id' => 'submitFiltroTimeline']) }}
        						</div>
                            </div>

                            <div class="col-md-6">
                            </div>

                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>
<?php // FIM - Pesquisa avançada ?>





















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
    <div class="col-md-3">
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
        </div><!-- /.box .box-primary -->
    </div>
</div>

<table id="lista-clientes" class="table table-bordered table-hover powertabela" style="background-color: white; padding: 7px;">
    <thead>
        <tr>
            <th>Hidrômetro</th>
            <th># ID</th>
            <th>Data</th>
            <th>m³</th>
            <th>Acumulado</th>
            <th>Último Lançamento</th>
            <th>Valor Acumulado</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td>000289000000</td>
            <td>01</td>
            <td>05/10/2018</td>
            <td>13m³</td>
            <td>42m³</td>
            <td>R$ 244,50</td>
            <td>R$ 48,55</td>


        </tr>

    </tbody>
</table>



@stop
