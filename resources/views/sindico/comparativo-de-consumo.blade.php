@extends('adminlte::page')

@section('title', 'MedirWeb')

@section('content_header')
<!-- <h1>Dashboard <small>Seja bem vindo</small></h1>
<ol class="breadcrumb">
    {{ date('d \d\e M \d\e Y ') }}
</ol> -->
@stop


{!! Html::style( asset('css/listaLeitura.css')) !!}
{!! Html::style( asset('css/total.css')) !!}

@section('content')
<div class="row">
    <div class="col-md-12">        
        <input class="form-control w-100 pesquisar" type="search" placeholder="Pesquise por nome, bloco, apartamento ou CPF">
    </div>
</div>

<br>
<div class="row">
    <div class="col-md-12">
        <h3 class="text-center tituloCentral">Comparativo de Consumo</h3>
    </div>
    <div class="col-md-12">
        <div class="row">
            <form>
                <div class="col-md-2">
                    <select name="bloco" class="form-control">
                        <option>bloco</option>
                        @foreach($blocos as $bloco)
                        <option value="{{ $bloco->nome }}">bloco {{ $bloco->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="unidade" class="form-control">
                        <option>unidade</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="ano" class="form-control">
                        <option>ano</option>
                        @foreach(range(now()->year, 2017) as $ano)
                        <option value="{{ $ano }}">ano {{ $ano }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="mes" class="form-control">
                        <option>mes</option>
                        <option value="1">1º Semestre</option>
                        <option value="2">2º Semestre</option>
                    </select>
                </div>

                <div class="col-md-1">
                    <button class="btn btn-danger botaoIr">Aplicar</button>
                </div>
            </form>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="1">Unidade</th>
                    <th colspan="">{{ $meses[now()->subMonth(2)->month] }}</th>
                    <th>{{ $meses[now()->subMonth(1)->month] }}</th>
                    <th>{{ $meses[now()->subMonth(0)->month] }}</th>
                </tr>
            </thead>
            <tbody class="leituras">

            </tbody>
        </table>
    </div>

</div>
@stop


@push('js')
<script src="/js/sindico_comparativo_de_consumo.js"></script>
@endpush