@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
    <h1>Equipamentos <small>Adicionar Equipamento</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Equipamentos</a></li>
        <li class="active">Adicionar</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
        {!! Form::open(['action' => 'EquipamentoController@store', 'method' => 'POST']) !!}

        <!-- Dados de Identificação -->

            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-home"></i> Dados de identificação</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class='box-body'>
                    <div class='row'>

                        <div class='col-md-6'>
                            <div class='form-group'>
                                {{ Form::label('EQP_IDUNIDADE', 'ID da Unidade') }}
                                {{ Form::text('EQP_IDUNIDADE', '', ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div class='form-group'>
                                {{ Form::label('EQP_IDFUNCIONAL', 'ID Funcional') }}
                                {{ Form::text('EQP_IDFUNCIONAL', '', ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div class='form-group'>
                                {{ Form::label('EQP_SERIAL', 'Nº de Serial') }}
                                {{ Form::text('EQP_SERIAL', '', ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div class='form-group'>
                                {{ Form::label('EQP_FABRICANTE', 'Fabricante') }}
                                {{ Form::text('EQP_FABRICANTE', '', ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class='form-group'>
                                {{ Form::label('EQP_MODELO', 'Modelo') }}
                                {{ Form::text('EQP_MODELO', '', ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div class='form-group'>
                                {{ Form::label('EQP_OPERADORA', 'Operadora') }}
                                {{ Form::text('EQP_OPERADORA', '', ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div class='form-group'>
                                {{ Form::label('EQP_STATUS', 'Status') }}
                                <select name='EQP_STATUS' class='form-control' >
                                    <option value='' selected>Selecione</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- [FIM] Dados de Identificação -->

            {!! Form::close() !!}

        </div><!-- /.col-md-8 -->

        <div class="col-md-4">

            <button type="button" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Salvar cadastro</button>

            <button type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>

        </div>

    </div>
@stop