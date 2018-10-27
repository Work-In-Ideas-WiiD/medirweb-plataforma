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
                                    <h3>5</h3>

                                    <p>Clientes</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Ver Clientes <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>

                        </div>

                        <div class='col-md-3'>

                            <div class="small-box bg-orange">
                                <div class="inner">
                                    <h3>18</h3>

                                    <p>Imóveis</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-building"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Ver Imóveis <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>

                        </div>

                        <div class='col-md-3'>

                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>22</h3>

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
                                    <h3>0</h3>

                                    <p>Ocorrências em aberto</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-exclamation-triangle"></i>
                                </div>
                                <a href="#" class="small-box-footer">
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
                            <table id="lista-hidrometros" class="table table-bordered table-hover powertabela">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Serial</th>
                                    <th>Localização</th>
                                    <th>Status</th>
                                    <th>Leitura atual</th>
                                    <th>Torre / Operadora</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>100001</td>
                                        <td>Goiânia - GO</td>
                                        <td>Configurado / Ativo</td>
                                        <td>0000445</td>
                                        <td>Radio / TIM</td>
                                    </tr>
                                    <tr>
                                        <td>02</td>
                                        <td>100002</td>
                                        <td>Goiânia - GO</td>
                                        <td>Configurado / Ativo</td>
                                        <td>0001891</td>
                                        <td>Torre / VIVO</td>
                                    </tr>
                                    <tr>
                                        <td>03</td>
                                        <td>100003</td>
                                        <td>Goiânia - GO</td>
                                        <td>Configurado / Ativo</td>
                                        <td>0000136</td>
                                        <td>Torre / Algar</td>
                                    </tr>
                                    <tr>
                                        <td>04</td>
                                        <td>100004</td>
                                        <td>Goiânia - GO</td>
                                        <td>Configurado / Ativo</td>
                                        <td>0000045</td>
                                        <td>Torre / TIM</td>
                                    </tr>
                                    <tr>
                                        <td>05</td>
                                        <td>100005</td>
                                        <td>Goiânia - GO</td>
                                        <td>Configurado / Ativo</td>
                                        <td>0011789</td>
                                        <td>Radio / Oi</td>
                                    </tr>
                                    <tr>
                                        <td>06</td>
                                        <td>100006</td>
                                        <td>Goiânia - GO</td>
                                        <td>Configurado / Ativo</td>
                                        <td>0000401</td>
                                        <td>Radio / TIM</td>
                                    </tr>
                                    <tr>
                                        <td>07</td>
                                        <td>100007</td>
                                        <td>Goiânia - GO</td>
                                        <td>Configurado / Ativo</td>
                                        <td>0000445</td>
                                        <td>Torre / Oi</td>
                                    </tr>
                                    <tr>
                                        <td>08</td>
                                        <td>100008</td>
                                        <td>Goiânia - GO</td>
                                        <td>Configurado / Ativo</td>
                                        <td>0008457</td>
                                        <td>Radio / TIM</td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

