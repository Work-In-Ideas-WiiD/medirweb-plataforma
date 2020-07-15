@extends('adminlte::page')

@section('title', 'MedirWeb')

@section('content_header')
<h1>Dashboard <small>Seja bem vindo</small></h1>
<ol class="breadcrumb">
    {{ date('d \d\e M \d\e Y ') }}
</ol>
@stop

@section('content')
@include('sindico.unidade_modal')
<div class="row">
    <div class="col-md-12">        
        <input class="form-control w-100" type="search" placeholder="Pesquise por nome, bloco, apartamento ou CPF">
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-1">
        @foreach ($blocos as $bloco)
            <p><a href="javascript:void(0)" class="escolher-bloco" data-bloco="{{ $bloco['nome'] }}">Bloco {{ $bloco['nome'] }}</a></p>
        @endforeach
    </div>
    <div class="col-md-11">
        <div class="row listar-unidades">
        </div>
    </div>
</div>
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
<br>
<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">Comparativo de consumo ultimos 6 meses</h3>
    </div>
    <div class="col-md-9">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Unidade</th>
                    <th>{{ $mes[now()->subMonth(5)->month] }}</th>
                    <th>{{ $mes[now()->subMonth(4)->month] }}</th>
                    <th>{{ $mes[now()->subMonth(3)->month] }}</th>
                    <th>{{ $mes[now()->subMonth(2)->month] }}</th>
                    <th>{{ $mes[now()->subMonth(1)->month] }}</th>
                    <th>{{ $mes[now()->subMonth(0)->month] }}</th>
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
<script src="/js/sindico_unidade_unidades.js"></script>
<script src="/js/sindico_unidade_comparativo.js"></script>
<script src="/js/sindico_unidade_escolher_ecomparar.js"></script>
<script src="/js/sindico_unidade_grafico.js"></script>
<script src="/js/sindico_unidade_modal.js"></script>
@endpush