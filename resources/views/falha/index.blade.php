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
            {!! Form::open(['method' => 'POST', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) !!}

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
                                            {{ Form::date('data_anterior', date("Y-m-d", strtotime('-1 month')), ['class'=>'form-control', 'required']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class='form-group'>
                                            {{ Form::label('', 'Data Final (Atual)') }}
                                            {{ Form::date('data_atual', date("Y-m-d"), ['class'=>'form-control', 'required']) }}
                                        </div>
                                    </div>

                                    <div class='col-md-4'>
                                        <div class='form-group'>
                                            {{ Form::label('', 'Imóvel') }}
                                            {{ Form::select('imovel_id', $imoveis, null, ['class' => 'avalidate form-control']) }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                  
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
        @if(!empty($falhas))

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
                                    <th>Imóvel</th>
                                    <th>Nome Responsável</th>
                                    <th>Apartamento</th>
                                    <th>ID Funcional</th>
                                    <th>Status</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody >
                                @foreach ($falhas as $falha)
                                <tr>
                                    <td>{{ $falha->id }}</td>
                                    <td>{{ $falha->prumada->nome }}</td>
                                    <td>{{ $falha->prumada->unidade->imovel->nome }}</td>
                                    <td>{{ $falha->prumada->unidade->nome_responsavel }}</td>
                                    <td>{{ $falha->prumada->unidade->nome }}</td>
                                    <td>{{ $falha->prumada->funcional_id }}</td>
                                    <td>{{ $falha->status }}</td>
                                    <td>{{ $falha->created_at }}</td>
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

       

    </div>
    <?php // FIM - Resultados ?>

</div>

@stop
