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

{!! Form::open(['action' => 'PrumadaController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) !!}
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
                            {{ Form::select('unidade_id', ['' => 'Selecionar Unidade'], null, ['class' => 'avalidate form-control']) }}

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
                            {{ Form::select('agrupamento_id', ['' => 'Selecionar Agrupamento'], null, ['class' => 'avalidate form-control chosen-select-PRU_IDAGRUPAMENTO', 'autocomplete' => 'off']) }}

                            @error('agrupamento_id')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class='form-group'>
                            {{ Form::label('PRU_NOME', 'Nome') }}
                            {{ Form::text('PRU_NOME', null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('PRU_NOME'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('PRU_NOME') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class='form-group'>
                            {{ Form::label('PRU_SERIAL', 'Nº de Serial') }}
                            {{ Form::text('PRU_SERIAL', null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('PRU_SERIAL'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('PRU_SERIAL') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class='form-group'>
                            {{ Form::label('PRU_MODELO', 'Modelo') }}
                            {{ Form::text('PRU_MODELO', null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('PRU_MODELO'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('PRU_MODELO') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">

                                  <div class="col-md-6">
                                      <div class='form-group'>
                                          {{ Form::label('PRU_TIPO', 'Tipo') }}
                                          {{ Form::select('PRU_TIPO', ['' => 'Selecione... ', 1 => 'Água', 2 => 'Gás', 3 => 'Energia'], null, ['class' => 'form-control']) }}

                                          @if ($errors->has('PRU_TIPO'))
                                          <span class="help-block">
                                              <strong style="color: red;">{{ $errors->first('PRU_TIPO') }}</strong>
                                          </span>
                                          @endif
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class='form-group'>
                                          {{ Form::label('PRU_STATUS', 'Status') }}
                                          {{ Form::select('PRU_STATUS', [1 => 'Ativo', 0 => 'Inativo'], null, ['class' => 'form-control']) }}

                                          @if ($errors->has('PRU_STATUS'))
                                          <span class="help-block">
                                              <strong style="color: red;">{{ $errors->first('PRU_STATUS') }}</strong>
                                          </span>
                                          @endif
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
