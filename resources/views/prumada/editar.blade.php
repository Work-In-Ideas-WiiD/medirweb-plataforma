@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Equipamentos <small>Atualizar Equipamento</small></h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#">Equipamentos</a></li>
  <li class="active">Atualizar</li>
</ol>
@stop

@section('content')
<div class="row">
  <div class="col-md-8">
    {!! Form::model($prumadas, ['route' => ['prumada.update', $prumadas->PRU_ID], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

    <!-- Dados de Identificação -->

    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-cog"></i> Dados de identificação</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>

      <div class='box-body'>
        <div class='row'>

          <div class='col-md-6'>

            <?php //Imovel ?>
            <div class='form-group'>
              {{ Form::label('PRU_IDIMOVEL', 'Imóvel') }}
              {{ Form::select('PRU_IDIMOVEL', $imoveis, null, ['class' => 'avalidate form-control', 'disabled' => 'disabled', 'autocomplete' => 'off']) }}

              @if ($errors->has('PRU_IDIMOVEL'))
              <span class="help-block">
                <strong style="color: red;">{{ $errors->first('PRU_IDIMOVEL') }}</strong>
              </span>
              @endif
            </div>

            <?php // Unidade?>
            <div class='form-group'>
              {{ Form::label('PRU_IDUNIDADE', 'Unidade') }}
              {{ Form::select('PRU_IDUNIDADE', $unidades, null, ['class' => 'avalidate form-control', 'disabled' => 'disabled', 'autocomplete' => 'off']) }}

              @if ($errors->has('PRU_IDUNIDADE'))
              <span class="help-block">
                <strong style="color: red;">{{ $errors->first('PRU_IDUNIDADE') }}</strong>
              </span>
              @endif
            </div>

            <?php // N de Serial ?>
            <div class='form-group'>
              {{ Form::label('PRU_SERIAL', 'Nº de Serial') }}
              {{ Form::text('PRU_SERIAL', null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

              @if ($errors->has('PRU_SERIAL'))
              <span class="help-block">
                <strong style="color: red;">{{ $errors->first('PRU_SERIAL') }}</strong>
              </span>
              @endif
            </div>

            <?php // FABRICANTE ?>
            <div class='form-group'>
              {{ Form::label('PRU_FABRICANTE', 'Fabricante') }}
              {{ Form::text('PRU_FABRICANTE', null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}


              @if ($errors->has('PRU_FABRICANTE'))
              <span class="help-block">
                <strong style="color: red;">{{ $errors->first('PRU_FABRICANTE') }}</strong>
              </span>
              @endif
            </div>

            <?php // Status ?>
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

          <div class="col-md-6">

            <?php //Agrupamento ?>
            <div class='form-group'>
              {{ Form::label('PRU_IDAGRUPAMENTO', 'Agrupamento') }}
              {{ Form::select('PRU_IDAGRUPAMENTO', $agrupamentos, null, ['class' => 'avalidate form-control', 'disabled' => 'disabled', 'autocomplete' => 'off']) }}

              @if ($errors->has('PRU_IDAGRUPAMENTO'))
              <span class="help-block">
                <strong style="color: red;">{{ $errors->first('PRU_IDAGRUPAMENTO') }}</strong>
              </span>
              @endif
            </div>

            <?php // ID FUNCIONAL ?>
            <div class='form-group'>
              {{ Form::label('PRU_IDFUNCIONAL', 'ID Funcional') }}
              {{ Form::text('PRU_IDFUNCIONAL', null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

              @if ($errors->has('PRU_IDFUNCIONAL'))
              <span class="help-block">
                <strong style="color: red;">{{ $errors->first('PRU_IDFUNCIONAL') }}</strong>
              </span>
              @endif
            </div>

            <?php // Operadora ?>
            <div class='form-group'>
              {{ Form::label('PRU_OPERADORA', 'Operadora') }}
              {{ Form::text('PRU_OPERADORA', null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

              @if ($errors->has('PRU_OPERADORA'))
              <span class="help-block">
                <strong style="color: red;">{{ $errors->first('PRU_OPERADORA') }}</strong>
              </span>
              @endif
            </div>

            <?php // MODELO ?>
            <div class='form-group'>
              {{ Form::label('PRU_MODELO', 'Modelo') }}
              {{ Form::text('PRU_MODELO', null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

              @if ($errors->has('PRU_MODELO'))
              <span class="help-block">
                <strong style="color: red;">{{ $errors->first('PRU_MODELO') }}</strong>
              </span>
              @endif
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- [FIM] Dados de Identificação -->

  </div><!-- /.col-md-8 -->

  <div class="col-md-4">

    <button type="submit" type="button" class="btn btn-block btn-warning"><i class="fa fa-pencil"></i> Atualizar cadastro</button>

    <button onclick="history.back()" type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>

  </div>

  {!! Form::close() !!}

</div>
@stop
