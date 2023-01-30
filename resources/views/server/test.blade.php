@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1><i class="fa fa-cloud"></i> Teste de Conexão com o Servidor</h1>
@stop

@section('content')

{!! Form::open(['action' => 'ServerController@processTest', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<div class="col-md-12">
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class='box-body'>
                <div class="col-md-9">
                    <div class="row">
                        <div class='form-group'>
                            {{ Form::label('imovel_id', 'Imóvel') }}
                            {{ Form::select('imovel_id', $imoveis, null, ['class' => 'avalidate form-control', 'required']) }}

                            @error('imovel_id')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('', '&nbsp;') }}
                        <button type="submit" type="button" style="width: 100% "class="btn btn-primary"><i class="fa fa-check"></i> Checar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}


@if(!empty($imovel->ip))
<div class="col-md-12">
    <div class="row" style="margin-top: 40px; margin-bottom: 40px;">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-3">
                    <div class="box box-warning" style="margin-top: -15px;">
                        <div class="box-header with-border gray" style="background-color: #f39c12; color: white; text-align: center;">
                            <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;">Endereço</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class='box-body'>
                            <p style="text-align: center; font-weight: 600; font-size: 18px;" >{{ $imovel->ip }}</p>
                        </div>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="box box-success" style="margin-top: -15px;">
                        <div class="box-header with-border gray" style="background-color: #00a65a; color: white; text-align: center;">
                            <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;">Status</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class='box-body'>

                            @if($codigoHTTP == 200)
                            <p style="text-align: center; font-weight: 600; font-size: 18px;" ><i class="fa fa-2x fa-check-circle text-success"></i><br>Servidor está respondendo!</p>
                            @elseif($codigoHTTP == 0)
                            <p style="text-align: center; font-weight: 600; font-size: 18px;" ><i class="fa fa-2x fa-times-circle text-danger"></i><br>Servidor não está respondendo!</p>

                            @elseif($codigoHTTP == 400)
                            <p style="text-align: center; font-weight: 600; font-size: 18px;" ><i class="fa fa-2x fa-times-circle text-danger"></i><br>Requisição inválida!</p>
                            @elseif($codigoHTTP == 401)
                            <p style="text-align: center; font-weight: 600; font-size: 18px;" ><i class="fa fa-2x fa-times-circle text-danger"></i><br>Acesso não autorizado!</p>
                            @elseif($codigoHTTP == 402)
                            <p style="text-align: center; font-weight: 600; font-size: 18px;" ><i class="fa fa-2x fa-times-circle text-danger"></i><br>Pagamento necessário!</p>
                            @elseif($codigoHTTP == 403)
                            <p style="text-align: center; font-weight: 600; font-size: 18px;" ><i class="fa fa-2x fa-times-circle text-danger"></i><br>Acesso proibido!</p>
                            @elseif($codigoHTTP == 404)
                            <p style="text-align: center; font-weight: 600; font-size: 18px;" ><i class="fa fa-2x fa-times-circle text-danger"></i><br>Não encontrado!</p>
                            @elseif($codigoHTTP == 405)
                            <p style="text-align: center; font-weight: 600; font-size: 18px;" ><i class="fa fa-2x fa-times-circle text-danger"></i><br>Método não permitido!</p>
                            @elseif($codigoHTTP == 406)
                            <p style="text-align: center; font-weight: 600; font-size: 18px;" ><i class="fa fa-2x fa-times-circle text-danger"></i><br>Não Aceitável!</p>
                            @elseif($codigoHTTP == 407)
                            <p style="text-align: center; font-weight: 600; font-size: 18px;" ><i class="fa fa-2x fa-times-circle text-danger"></i><br>Autenticação de proxy necessária!</p>
                            @elseif($codigoHTTP == 408)
                            <p style="text-align: center; font-weight: 600; font-size: 18px;" ><i class="fa fa-2x fa-times-circle text-danger"></i><br>Tempo de requisição esgotou (Timeout)!</p>

                            @elseif($codigoHTTP == 500)
                            <p style="text-align: center; font-weight: 600; font-size: 18px;" ><i class="fa fa-2x fa-warning text-danger"></i><br>Erro interno do servidor!<br>(Internal Server Error)</p>

                            @else
                            <p style="text-align: center; font-weight: 600; font-size: 18px;" ><i class="fa fa-2x fa-question-circle text-danger"></i><br>Status desconhecido!</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="box box-primary" style="margin-top: -15px;">
                        <div class="box-header with-border gray" style="background-color: #3c8dbc; color: white; text-align: center;">
                            <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"></i> Codigo HTTP</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class='box-body'>
                            <p style="text-align: center; font-weight: 600; font-size: 18px;" >{{ $codigoHTTP }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endif

<?php // FIM - Resultados ?>
@stop
