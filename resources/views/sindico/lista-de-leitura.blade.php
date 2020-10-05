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
        <h3 class="text-center tituloCentral">Lista de Leituras<div class="icon iconeFuncao">
                    <i class="fa fa-file-o"></i>
                </div>
                <div class="icon iconeFuncao2 lista para-ir" data-para-ir="#link-aqui">
                    <i class="fa fa-file-excel-o"></i>
                </div>
                <div class="icon iconeFuncao3">
                    <i class="fa fa-print"></i>
                </div></h3>
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

                <div class="col-md-3">
                    <label class="labelInput">De</label>
                    <input type="date" style="width:90%; float:right;" class="form-control filtro" name="data_inicio" placeholder="data de inicio">
                </div>

                <div class="col-md-3">
                    <label class="labelInput">Até</label>
                    <input type="date" style="width:90%; float:right;" class="form-control filtro" name="data_fim" placeholder="data fim">
                </div>

                <div class="col-md-1">
                    <button class="btn btn-danger verificarBotao botaoIr" disabled>Aplicar<i class="fa fa-refresh fa-spin loadIcone"></i></button>
                </div>
            </form>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Data e Hora</th>
                    <th>Leitura Acumulada</th>
                    <th>Consumo Acumulado</th>
                </tr>
            </thead>
            <tbody class="leituras">

            </tbody>
        </table>
    </div>

</div>
@stop


@push('js')
<script src="/js/sindico_lista_de_leitura.js"></script>
<script>
    $('.verificarBotao').click(function() {
        let bloco = $('[name=bloco]').val()

        let unidade = $('[name=unidade]').val()

        let data_inicio = $('[name=data_inicio]').val()

        let data_fim = $('[name=data_fim]').val()

        let url = `/sindico/export/consumo-leitura-por-unidade/${bloco}/${unidade}/${data_inicio}/${data_fim}`

        $(".lista").data('para-ir', url)
    })

</script>

@endpush