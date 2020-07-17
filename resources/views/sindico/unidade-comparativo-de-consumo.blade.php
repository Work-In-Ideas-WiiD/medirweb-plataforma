@extends('adminlte::page')

@section('title', 'MedirWeb')

@section('content_header')
<h1>Dashboard <small>Seja bem vindo</small></h1>
<ol class="breadcrumb">
    {{ date('d \d\e M \d\e Y ') }}
</ol>
@stop

@section('content')

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
        <div class="row">
            <div class="col-md-3">
                <div class="bg-info">1</div>
            </div>
            <div class="col-md-3">
                <div class="bg-info">2</div>
            </div>
            <div class="col-md-3">
                <div class="bg-info">3</div>
            </div>
            <div class="col-md-3">
                <div class="bg-info">4</div>
            </div>
        </div>
    </div>
</div>
<br>
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
<script src="/js/sindico_unidade.js"></script>
@endpush