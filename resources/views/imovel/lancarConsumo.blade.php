@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Imóveis <small>Lançar Consumo</small></h1>

<div class="row" style="margin-top: 5px;">
	<div class="col-md-12">
		<div class="row">

			<div class="col-md-5">
        <h4 ><i class="fa fa-building"></i> {{ $imovel->nome }}</h4>
			</div>

			<div class="col-md-7">
				<div id="loading" class="loading oculto">
					<div style="margin-top:10px;">
						<div class="carregar"></div>
						<p style="margin-top:-20px; color:red;">&emsp;&emsp;Requisição em andamento. <font color="red" id="aguarde"></font></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/imovel">Imóveis</a></li>
    <li class="active">Lançar Consumo</li>
</ol>
@stop

@section('content')

@if(!empty($mesCiclo))

{!! Form::model($imovel, ['action' => 'ImovelController@postLancarConsumo', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) !!}
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-tachometer"></i> <i class="fa fa-dollar"></i> Lancamento de Consumo Mensal do Fornecedor</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class='box-body'>
                <div class='row'>

                    <div class='col-md-4'>
                        <div class='form-group'>
                            {{ Form::label('data_leitura_fornecedor', 'Dia da Leitura') }}
                            {{ Form::hidden('imovel_id', null, ['class' => 'avalidate form-control']) }}
                            {{ Form::select('data_leitura_fornecedor', $mesCiclo, date("Y-m-d"), ['class' => 'avalidate form-control']) }}

                            @error('data_leitura_fornecedor')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class='col-md-4'>
                        <div class='form-group'>
                            {{ Form::label('metro_fornecedor', 'Leitura m³') }}
                            {{ Form::text('metro_fornecedor', '', ['class' => 'avalidate form-control mask-inteiro']) }}

                            @error('metro_fornecedor')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class='form-group'>
                            {{ Form::label('metro_valor_fornecedor', 'Valor (R$)') }}
                            {{ Form::text('metro_valor_fornecedor', '', ['class' => 'avalidate form-control mask-dinheiro']) }}

                            @error('metro_valor_fornecedor')
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
        <button type="submit" type="button" id="ocultar" onclick="loading()" class="btn btn-block btn-success ocultar"><i class="fa fa-floppy-o"></i> Adicionar</button>
        <button onclick="history.back()" type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>
    </div>
</div>
{!! Form::close() !!}

@endif

@if(!empty($faturas))

<div class="row">

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-9">
                <div class="alert alert-danger" role="alert">
                    ATENÇÃO! Este mês já foi coletado o consumo mensal do fornecedor!
                </div>
            </div>
            <div class="col-md-3">
                <button onclick="history.back()" type="button" class="btn btn-block btn-danger"><i class="fa fa-reply"></i> Voltar</button>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">

            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header with-border gray" style="background-color: #3c8dbc; color: white; text-align: center;">
                        <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"></i> Consumo do Fornecedor</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class='box-body'>
                        @foreach($faturas as $fatura)
                        <div style=" bottom:15px; position: relative;">
                            <small><i class="fa fa-calendar"></i> {{ date('d/m/Y', strtotime($fatura->data_leitura_fornecedor)) }}</small>
                        </div>
                        <p style="text-align: center; font-weight: 600; font-size: 18px;" >{{ $fatura->consumo_fornecedor }}m³</p>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-header with-border gray" style="background-color: #00a65a; color: white; text-align: center;">
                        <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"> Valor do Fornecedor</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class='box-body'>
                        @foreach($faturas as $fatura)
                        <div style=" bottom:15px; position: relative;">
                            <small><i class="fa fa-calendar"></i> {{ date('d/m/Y', strtotime($fatura->data_leitura_fornecedor)) }}</small>
                        </div>
                        <p style="text-align: center; font-weight: 600; font-size: 18px;" >R$ {{ $fatura->metro_valor_fornecedor }}</p>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box box-warning">
                    <div class="box-header with-border gray" style="background-color: #f39c12; color: white; text-align: center;">
                        <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;">Consumo Área Comum do Imóvel</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class='box-body'>
                        @foreach($faturas as $fatura)
                        <div style=" bottom:15px; position: relative;">
                            <small><i class="fa fa-calendar"></i> {{ date('m-Y', strtotime($fatura->data_leitura_fornecedor)) }}</small>
                        </div>
                        <p style="text-align: center; font-weight: 600; font-size: 18px;" >{{ $fatura->consumo_imovel }}m³ - R$ {{ $fatura->consumo_valor_imovel }}</p>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-12">
        <div class="row">

            <div class="col-md-3">
                <div class="box box-info">
                    <div class="box-header with-border gray" style="background-color: #00c0ef; color: white; text-align: center;">
                        <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"> Consumo das Unidades</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class='box-body'>
                        @foreach($faturas as $fatura)
                        <div style=" bottom:15px; position: relative;">
                            <small><i class="fa fa-calendar"></i> {{ date('m-Y', strtotime($fatura->data_leitura_fornecedor)) }}</small>
                        </div>
                        <p style="text-align: center; font-weight: 600; font-size: 18px;" >{{ $fatura->consumo_unidade }}m³</p>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box box-danger">
                    <div class="box-header with-border gray" style="background-color: #dd4b39; color: white; text-align: center;">
                        <h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"></i> Valor Consumo das Unidades</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class='box-body'>
                        @foreach($faturas as $fatura)
                        <div style=" bottom:15px; position: relative;">
                            <small><i class="fa fa-calendar"></i> {{ date('m-Y', strtotime($fatura->data_leitura_fornecedor)) }}</small>
                        </div>
                        <p style="text-align: center; font-weight: 600; font-size: 18px;" > R$ {{ $fatura->consumo_valor_unidade }}</p>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endif

@stop
