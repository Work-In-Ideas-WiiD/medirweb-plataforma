@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Importar CSV</h1>
<ol class="breadcrumb">
    <li><a href="/Home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Time</a></li>
    <li><a href="#">Equipamentos</a></li>
    <li class="active">Adicionar Ocorrência</li>
</ol>
@stop

@section('content')
{!! Form::open(['url' => '/importar/csv', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
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

                        <div class="form-group">
                            {{ Form::label('imovel', 'Imóvel') }}
                            {{ Form::select('imovel', $imoveis, null, ['class' => 'avalidate form-control']) }}
                            @if ($errors->has('imovel'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('imovel') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('csv', 'Arquivo CSV') }}
                            {{ Form::file('csv', ['class' => 'form-control', 'accept' => '.csv']) }}
                        </div>                    

                    </div>

                </div>

                <?php // Descrição ?>
                <div class='form-group'>
                    <span class="help-block">
                        <strong style="color: red;">{{ $errors->first('TIMELINE_DESCRICAO') }}</strong>
                    </span>

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
