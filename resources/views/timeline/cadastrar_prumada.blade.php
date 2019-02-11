@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>TimeLine <small>Adicionar Ocorrência Equipamento</small></h1>
<ol class="breadcrumb">
    <li><a href="/Home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Time</a></li>
    <li><a href="#">Equipamentos</a></li>
    <li class="active">Adicionar Ocorrência</li>
</ol>
@stop

@section('content')
{!! Form::open(['action' => 'TimelineController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<div class="row">
    <div class="col-md-8">
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

                        <?php //Imovel ?>
                        <div class='form-group'>
                            {{ Form::label('PRU_IDIMOVEL', 'Imóvel') }}
                            {{ Form::select('PRU_IDIMOVEL', $imoveis, null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('PRU_IDIMOVEL'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('PRU_IDIMOVEL') }}</strong>
                            </span>
                            @endif
                        </div>

                        <?php // Unidade?>
                        <div class='form-group'>
                            {{ Form::label('PRU_IDUNIDADE', 'Unidade') }}
                            {{ Form::select('PRU_IDUNIDADE', ['' => 'Selecionar Unidade'], null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('PRU_IDUNIDADE'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('PRU_IDUNIDADE') }}</strong>
                            </span>
                            @endif
                        </div>

                        <?php // Usuario ?>
                        <div class='form-group'>
                            {{ Form::text('TIMELINE_USER', auth()->user()->name, ['class' => 'avalidate form-control', 'style' => 'display:none', 'autocomplete' => 'off']) }}
                            @if ($errors->has('TIMELINE_USER'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('TIMELINE_USER') }}</strong>
                            </span>
                            @endif
                        </div>

                        <?php // ICONE ?>
                        <div class='form-group'>
                            {{ Form::text('TIMELINE_ICON', 'fa fa-comments bg-blue', ['class' => 'avalidate form-control', 'style' => 'display:none', 'autocomplete' => 'off']) }}

                        </div>

                    </div>

                    <div class="col-md-6">

                        <?php //Agrupamento ?>
                        <div class='form-group'>
                            {{ Form::label('PRU_IDAGRUPAMENTO', 'Agrupamento') }}
                            {{ Form::select('PRU_IDAGRUPAMENTO', ['' => 'Selecionar Agrupamento'], null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('PRU_IDAGRUPAMENTO'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('PRU_IDAGRUPAMENTO') }}</strong>
                            </span>
                            @endif
                        </div>

                        <?php //Equipamento ?>
                        <div class='form-group'>
                            {{ Form::label('TIMELINE_IDPRUMADA', 'Equipamento') }}
                            {{ Form::select('TIMELINE_IDPRUMADA', ['' => 'Selecionar Equipamento'], null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('TIMELINE_IDPRUMADA'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('TIMELINE_IDPRUMADA') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div>
                </div>

                <?php // Descrição ?>
                <div class='form-group'>
                    {{ Form::label('TIMELINE_DESCRICAO', 'Descrição') }}
                    {{ Form::textarea('TIMELINE_DESCRICAO', null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                    @if ($errors->has('TIMELINE_DESCRICAO'))
                    <span class="help-block">
                        <strong style="color: red;">{{ $errors->first('TIMELINE_DESCRICAO') }}</strong>
                    </span>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <button type="submit" type="button" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Salvar Ocorrência</button>
        <button onclick="history.back()" type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>
    </div>
</div>
{!! Form::close() !!}
@stop
