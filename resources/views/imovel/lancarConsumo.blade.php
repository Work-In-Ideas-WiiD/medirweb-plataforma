@extends('adminlte::page')

@section('title', 'MedirWeb')

@section('content_header')
<h1>Imóveis <small>Lançar Consumo</small></h1>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/imovel">Imóveis</a></li>
    <li class="active">Lançar Consumo</li>
</ol>
@stop

@section('content')

@if(!empty($mesCiclo))

{!! Form::open(['action' => 'ImovelController@postLancarConsumo', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
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
                            {{ Form::label('FAT_DTLEIFORNECEDOR', 'Dia da Leitura') }}
                            {{ Form::text('FAT_IMOID', $id, ['class' => 'avalidate form-control', 'style' => 'display:none']) }}
                            {{ Form::select('FAT_DTLEIFORNECEDOR', $mesCiclo, date("Y-m-d"), ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('FAT_DTLEIFORNECEDOR'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('FAT_DTLEIFORNECEDOR') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class='col-md-4'>
                        <div class='form-group'>
                            {{ Form::label('FAT_LEIMETRO_FORNECEDOR', 'Consumo m³') }}
                            {{ Form::text('FAT_LEIMETRO_FORNECEDOR', '', ['class' => 'avalidate form-control mask-inteiro', 'placeholder' => '']) }}

                            @if ($errors->has('FAT_LEIMETRO_FORNECEDOR'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('FAT_LEIMETRO_FORNECEDOR') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class='form-group'>
                            {{ Form::label('FAT_LEIMETRO_VALORFORNECEDOR', 'Valor (R$)') }}
                            {{ Form::text('FAT_LEIMETRO_VALORFORNECEDOR', '', ['class' => 'avalidate form-control mask-dinheiro', 'placeholder' => '']) }}

                            @if ($errors->has('FAT_LEIMETRO_VALORFORNECEDOR'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('FAT_LEIMETRO_VALORFORNECEDOR') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <button type="submit" type="button" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Adicionar</button>
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

    <?php // Fornecedor ?>
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
                            <small><i class="fa fa-calendar"></i> {{ date('d/m/Y', strtotime($fatura->FAT_DTLEIFORNECEDOR)) }}</small>
                        </div>
                        <p style="text-align: center; font-weight: 600; font-size: 18px;" >{{ $fatura->FAT_CONSUMO_FORNECEDOR }}m³</p>
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
                            <small><i class="fa fa-calendar"></i> {{ date('d/m/Y', strtotime($fatura->FAT_DTLEIFORNECEDOR)) }}</small>
                        </div>
                        <p style="text-align: center; font-weight: 600; font-size: 18px;" >R$ {{ $fatura->FAT_LEIMETRO_VALORFORNECEDOR }}</p>
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
                            <small><i class="fa fa-calendar"></i> {{ date('m-Y', strtotime($fatura->FAT_DTLEIFORNECEDOR)) }}</small>
                        </div>
                        <p style="text-align: center; font-weight: 600; font-size: 18px;" >{{ $fatura->FAT_CONSUMO_IMOVEL }}m³ - R$ {{ $fatura->FAT_CONSUMO_VALORIMOVEL }}</p>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php // UNIDADES ?>
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
                            <small><i class="fa fa-calendar"></i> {{ date('m-Y', strtotime($fatura->FAT_DTLEIFORNECEDOR)) }}</small>
                        </div>
                        <p style="text-align: center; font-weight: 600; font-size: 18px;" >{{ $fatura->FAT_CONSUMO_UNI }}m³</p>
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
                            <small><i class="fa fa-calendar"></i> {{ date('m-Y', strtotime($fatura->FAT_DTLEIFORNECEDOR)) }}</small>
                        </div>
                        <p style="text-align: center; font-weight: 600; font-size: 18px;" > R$ {{ $fatura->FAT_CONSUMO_VALORUNI }}</p>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endif

@stop
