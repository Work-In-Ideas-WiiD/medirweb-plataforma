@extends('adminlte::page')

@section('title', 'MedirWeb')

@section('content_header')
<h1>Dashboard <small>Seja bem vindo</small></h1>
<ol class="breadcrumb">
    {{ date('d \d\e M \d\e Y ', strtotime($datacalendario)) }}
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Resumo</h3>
            </div>

            <div class='box-body'>
                <div class='row'>

                    <div class="col-md-3">

                        <div class="small-box bg-teal">
                            <div class="inner">
                                <h3>{{ number_format($total_clientes, 0, '', '.') }}</h3>

                                <p>Clientes</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="/cliente" class="small-box-footer">
                                Ver Clientes <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>

                    </div>

                    <div class='col-md-3'>

                        <div class="small-box bg-orange">
                            <div class="inner">
                                <h3>{{ number_format($total_imovel, 0, '', '.') }}</h3>

                                <p>Imóveis</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-building"></i>
                            </div>
                            <a href="/imovel" class="small-box-footer">
                                Ver Imóveis <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>

                    </div>

                    <div class='col-md-3'>

                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{ number_format($ativos_hidrometros, 0, '', '.') }}</h3>

                                <p>Hidrometros ativos</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-cog"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Ver Hidrômetros <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>

                    </div>

                    <div class='col-md-3'>

                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>{{ number_format($total_timeline, 0, '', '.') }}</h3>

                                <p>Ocorrências</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-info"></i>
                            </div>
                            <a href="/timeline/equipamento" class="small-box-footer">
                                Ver Ocorrências <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Ultimos Hidrômetros ativos</h3>
            </div>

            <div class='box-body'>
                <div class='row'>
                    <div class='col-md-12'>
                        <table id="lista-hidrometros" class="table table-bordered table-hover powertabelaDesc">
                            <thead>
                                <tr>
                                    <th># Ocorrência</th>
                                    <th># Hidrômetro</th>
                                    <th>Serial</th>
                                    <th>Localização</th>
                                    <th>Status</th>
                                    <th>Leitura atual</th>
                                    <th>Operadora</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pruAtivas as $pruAtiva)
                                <tr>
                                    <td>{{ $pruAtiva['TIMELINE_ID'] }}</td>
                                    <td>{{ $pruAtiva['PRU_ID'] }}</td>
                                    <td>{{ $pruAtiva['PRU_SERIAL'] }}</td>
                                    <td>{{ $pruAtiva['localizacao'] }}</td>
                                    <td>
                                        @if($pruAtiva['PRU_STATUS'] == 1)
                                        Ativo
                                        @else
                                        Inativo
                                        @endif
                                    </td>
                                    <td>{{ $pruAtiva['leituraAtual'] }}</td>
                                    <td>{{ $pruAtiva['PRU_OPERADORA'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
