@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Equipamentos <small>Adicionar Equipamento</small></h1>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Equipamentos</a></li>
    <li class="active">Adicionar</li>
</ol>
@stop

@section('content')

{!! Form::open(['route' => 'prumada.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) !!}
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-cog"></i> Dados do Novo Equipamento</h3>
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
                            {{ Form::select('imovel_id', $imoveis, null, ['class' => 'avalidate form-control']) }}

                            @error('PRU_IDIMOVEL')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class='form-group'>
                            {{ Form::label('unidade_id', 'Unidade') }}
                            {{ Form::select('unidade_id', [], null, ['class' => 'avalidate form-control', 'placeholder' => 'Selecione a unidade']) }}

                            @error('unidade_id')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class='form-group'>
                            {{ Form::label('funcional_id', 'ID Funcional') }}
                            {{ Form::text('funcional_id', null, ['class' => 'avalidate form-control']) }}

                            @error('funcional_id')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class='form-group'>
                            {{ Form::label('fabricante', 'Fabricante') }}
                            {{ Form::text('fabricante', null, ['class' => 'avalidate form-control']) }}


                            @error('fabricante')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class='form-group'>
                            {{ Form::label('operadora', 'Operadora') }}
                            {{ Form::text('operadora', null, ['class' => 'avalidate form-control']) }}

                            @error('operadora')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class='form-group'>
                            {{ Form::label('agrupamento_id', 'Agrupamento') }}
                            {{ Form::select('agrupamento_id', $agrupamentos, null, ['class' => 'avalidate form-control', 'placeholder' => 'Selecionar Agrupamento']) }}

                            @error('agrupamento_id')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class='form-group'>
                            {{ Form::label('nome', 'Nome') }}
                            {{ Form::text('nome', null, ['class' => 'avalidate form-control']) }}

                            @error('nome')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class='form-group'>
                            {{ Form::label('serial', 'Nº de Serial') }}
                            {{ Form::text('serial', null, ['class' => 'avalidate form-control']) }}

                            @error('serial')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class='form-group'>
                            {{ Form::label('modelo', 'Modelo') }}
                            {{ Form::text('modelo', null, ['class' => 'avalidate form-control']) }}

                            @error('modelo')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">

                                  <div class="col-md-6">
                                      <div class='form-group'>
                                          {{ Form::label('tipo', 'Tipo') }}
                                          {{ Form::select('tipo', [1 => 'Água', 2 => 'Gás', 3 => 'Energia'], null, ['class' => 'form-control', 'placeholder' => 'Selecione... ']) }}

                                          @error('tipo')
                                          <span class="help-block">
                                              <strong style="color: red;">{{ $message }}</strong>
                                          </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class='form-group'>
                                          {{ Form::label('status', 'Status') }}
                                          {{ Form::select('status', [1 => 'Ativo', 0 => 'Inativo'], null, ['class' => 'form-control']) }}

                                          @error('status')
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
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <button type="submit" type="button" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Salvar cadastro</button>
        <button type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>
    </div>
</div>
{!! Form::close() !!}
@stop
