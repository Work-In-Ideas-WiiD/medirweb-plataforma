@extends('adminlte::page')

@section('title', 'MedirWeb')

@section('content_header')
<h1>Dashboard <small>Seja bem vindo</small></h1>
<ol class="breadcrumb">
    {{ date('d \d\e M \d\e Y ') }}
</ol>
@stop

@section('content')

<style>
    .circulos {
        padding-top: 15%;
        margin: auto;
        background: #3c8dbc;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        font-size:25px;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <input class="form-control w-100" type="search" placeholder="Pesquise por nome, bloco, apartamento ou CPF">
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        AA
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-6">
                <div class="bg-info">A</div>
            </div>
            <div class="col-md-6">
                <div class="bg-info">B</div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="row text-center">
            <div class="col-md-3">
                <div class="bg-info">
                    neste ano
                    <div class="circulos">-</div>
                    média mensal
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-info">
                    neste ano
                    <div class="circulos">-</div>
                    consumo total
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-info">
                    neste mês
                    <div class="circulos">-</div>
                    consumo total
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-info">
                    neste mês
                    <div class="circulos">-</div>
                    média de consumo do condomínio
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title text-center">Comparativo de consumo</h3>

                <!--div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button>
                </div-->
                </div>
                <div class="card-body">
                <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">Comparativo de consumo ultimos 6 meses</h3>
    </div>
    <div class="col-md-9">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Média consumo unidade</th>
                    <th>Média consumo bloco</th>
                    <th>Consumo total</th>
                </tr>
            </thead>
            <tbody class="tabela-comparativo-unidades">
            </tbody>
        </table>
    </div>

    <div class="col-md-3 bg-warning">
        <div class="h4">Comparativo</div>
        <div class="row" style="margin-bottom:15px;">
            <div class="col-md-6 text-center" id="unidade-e-mes0">-</div>
            <div class="col-md-6 text-center" id="consumo0">-</div>
        </div>
        <div class="row" style="margin-bottom:15px;">
            <div class="col-md-6 text-center" id="unidade-e-mes1">-</div>
            <div class="col-md-6 text-center" id="consumo1">-</div>
        </div>
        <div class="row" style="margin-bottom:15px;">
            <div class="col-md-6">
                <div class="text-center" style="background:#ff0047;" id="diferenca-consumo">-</div>
            </div>
            <div class="col-md-6">
                <div class="text-center" style="background:#ff0047;" id="diferenca-porcentagem">-</div>
            </div>
            
        </div>
    </div>
</div>
@stop


@push('js')
<script src="/js/sindico_unidade_comparativo_de_consumo.js"></script>
<script src="/js/sindico_unidade_comparativo_de_consumo_grafico.js"></script>

@endpush