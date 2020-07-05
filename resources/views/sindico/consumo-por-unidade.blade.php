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
        <h3 class="text-center">Consumo mensal por unidades</h3>
    </div>
    <div class="col-md-12">
        <div class="row">
            <form id="consumo-mensal">
                <div class="col-md-1">
                    <select name="bloco" class="form-control">
                        <option>bloco</option>
                        @foreach($blocos as $bloco)
                        <option value="{{ $bloco->nome }}">bloco {{ $bloco->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <!--div class="col-md-1">
                    <select name="mes" class="form-control">
                        <option>mes</option>
                    </select>
                </div-->

                <div class="col-md-1">
                    <select name="ano" class="form-control">
                        <option>ano</option>
                        @foreach(range(now()->year, 2017) as $ano)
                        <option value="{{ $ano }}">ano {{ $ano }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-1">
                    <button class="btn btn-danger">aplicar</button>
                </div>
            </form>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Unidade</th>
                    @foreach ($meses as $mes)
                    <th>{{ substr($mes, 0, 3) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="consumo-mensal">

            </tbody>
        </table>
    </div>
</div>

<br>
<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">Comparativo por diario por unidade</h3>
    </div>
    <div class="col-md-12">
        <div class="row">
            <form id="consumo-diario">
                <div class="col-md-1">
                    <select name="bloco-diario" class="form-control">
                        <option>bloco</option>
                        @foreach($blocos as $bloco)
                        <option value="{{ $bloco->nome }}">bloco {{ $bloco->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-1">
                    <select name="mes-diario" class="form-control">
                        <option>mes</option>
                        @foreach ($meses as $numero => $extenso)
                        <option value="{{ $numero }}">{{ $extenso }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-1">
                    <select name="ano-diario" class="form-control">
                        <option>ano</option>
                    </select>
                </div>

                <div class="col-md-1">
                    <button class="btn btn-danger">aplicar</button>
                </div>
            </form>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Unidade</th>
                    @foreach(range(1, now()->daysInMonth) as $day)
                    <th>{{ $day }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="consumo-diario">

            </tbody>
        </table>
    </div>
</div>
@stop


@push('js')
<script src="/js/sindico_consumo_por_unidade.js"></script>
@endpush