@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Agrupamentos <small>Adicionar Agrupamento</small></h1>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Agrupamentos</a></li>
    <li class="active">Adicionar</li>
</ol>
@stop

@section('content')
{!! Form::open(['action' => 'AgrupamentoController@store', 'method' => 'POST', 'autocomplete' => 'off']) !!}
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i> Dados do Novo Agrupamento</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class='box-body'>
                <div class='row'>

                    <div class='col-md-6'>
                        <div class='form-group'>
                            {{ Form::label('imovel_id', 'Imóvel') }}
                            {{ Form::select('imovel_id', $imoveis, null, ['class' => 'avalidate form-control', 'Selecione um imóvel']) }}

                            @error('imovel_id')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class='form-group'>
                            {{ Form::label('nome', 'Nome') }}
                            {{ Form::text('nome', '', ['class' => 'form-control']) }}

                            @error('nome')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class='form-group'>
                            {{ Form::label('repetidor_id', 'Repetidor') }}
                            {{ Form::text('repetidor_id', null, ['class' => 'form-control']) }}

                            @error('repetidor_id')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <button type="submit" type="button" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Salvar cadastro</button>
        <button onclick="history.back()" type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>
    </div>
</div>
{!! Form::close() !!}
@stop
