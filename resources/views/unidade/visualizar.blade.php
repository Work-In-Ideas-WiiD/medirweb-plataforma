@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Unidades <small>Vizualizar Unidades</small></h1>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-1">
                <a onclick="history.back()" class="btn btn-info"><i class="fa fa-reply"></i> Voltar</a>
            </div>
            <div class="col-md-4">
                <h4 ><i class="fa fa-home"></i> {{ $unidade->UNI_NOME }}</h4>
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
    <li><a href="#">Unidades</a></li>
    <li class="active">Vizualizar</li>
</ol>

@stop

@section('content')
<div class="row">

    <div class="col-md-8">

        <!-- Idenficação da Unidade -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-text-width"></i>
                <h3 class="box-title">Geral</h3>
            </div>
            <div class="box-body">
                <dl>
                    <dt>Proprietário</dt>
                    <dd class="infoprop" >{{ $unidade->UNI_RESPONSAVEL }} - {{ $unidade->UNI_CPFRESPONSAVEL }} - {{ $unidade->UNI_TELRESPONSAVEL }}</dd>
                    <dt>Idenficação do Apartamento</dt>
                    <dd class="infoprop" ><a class="linkbread" href="{{  url('/imovel/ver/'.$imovel->IMO_ID) }}">{{ $unidade->UNI_NOME }} - {{ $agrupamento->AGR_NOME }} - {{ $imovel->IMO_NOME }}</a></dd>
                </dl>
            </div>
        </div>
        <!-- fim -  Idenficação da Unidade -->

        <!-- Leitura -->
        <div class="box box-success" id="boxdeacoes">
            <div class="box-header with-border">
                <i class="fa fa-external-link"></i>
                <h3 class="box-title">Ações</h3>
            </div>
            <div class="box-body row">

                <div class="col-md-3 text-center">
                    <div class="form-group">
                        <select class="form-control">
                            <option>(Selecione a referência)</option>
                            <option selected="">Agosto/2018</option>
                            <option>Julho/2018</option>
                            <option>Junho/2018</option>
                            <option>Maio/2018</option>
                            <option>Abril/2018</option>
                            <option>Março/2018</option>
                            <option>Fevereiro/2018</option>
                            <option>Janeiro/2018</option>
                            <option>Dezembro/2017</option>
                            <option>Novembro/2017</option>
                        </select>
                    </div>
                </div>

                @foreach($prumadas as $prumada)
                <!-- Botao Leitura -->
                <div class="col-md-3 text-center">
                    <a href="{{ url('/imovel/'.$imovel->IMO_ID.'/leitura/'.$prumada->PRU_ID.'') }}" id="ocultar" onclick="loading()" class="btn btn-default ocultar"><i class="fa fa-retweet"></i> Leitura</a>
                </div>

                <!-- fim - Botao Leitura -->

                <!-- Botao Desligar / Ligar -->
                <div class="col-md-3 text-center">
                    @is(['Administrador', 'Sindico'])

                    @if($prumada->PRU_STATUS == 1)
                    <a href="{{ url('/imovel/'.$imovel->IMO_ID.'/desligar/'.$prumada->PRU_ID.'') }}" id="ocultar" onclick="loading()" class="btn btn-danger ocultar" ><i class="fa fa-close"></i> Efetuar corte</a>
                    @else
                    <a href="{{ url('/imovel/'.$imovel->IMO_ID.'/ligar/'.$prumada->PRU_ID.'') }}" id="ocultar" onclick="loading()" class="btn btn-success ocultar" ><i class="fa fa-power-off"></i> Ativação</a>
                    @endif

                    @endis
                </div>
                <!-- fim -  Botao Desligar / Ligar -->
                @endforeach

                <div class="col-md-3 text-center">
                    <a href="#" class="btn btn-default" disabled><i class="fa fa-calculator"></i> Faturamento</a>
                </div>

            </div>
        </div>
        <!-- fim - Leitura -->

        <!-- Consumo Atual -->
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-tachometer"></i> Consumo atual (m³) @if($unidade->getPrumadas()->count() > 0 ) @if($unidade->getPrumadas()->first()->PRU_STATUS == 1) <i class="fa fa-circle" style="color: #009900;"></i> @else <i class="fa fa-circle" style="color: #d73925;"></i> @endif @endif</h3>
            </div>
            <div class="box-body">
                <div class="bloco-medicao row">

                    <div class="col-md-5">
                        <div class="medicao-num">
                            @if(isset($ultimaleitura->LEI_METRO))
                            <p class="registronum" >{{ sprintf("%04d", $ultimaleitura->LEI_METRO) }} <span class="unidade" >m³</span></p>
                            @else
                            <p class="registronum" >0000 <span class="unidade" >m³</span></p>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-7">
                        @foreach($duasUltimaLeituras as $leitura)
                        <div class="medicao-num">
                            <table class="table" >
                                <tbody>
                                    <tr>
                                        <th>LEITURA ANTERIOR: <b>{{ $leitura->LEI_METRO }} m³</b></th>
                                        <th>DATA: <b>{{ date('d/m/Y', strtotime($leitura->created_at)) }}</b></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        <!-- fim - Consumo Atual -->

        <!-- Histórico de Leituras -->
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-hourglass-1"></i> Histórico de Leituras</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered" id="tabelaPrincipal">
                    <thead>
                        <th>#</th>
                        <th>m³</th>
                        <th>lt</th>
                        <th>dl</th>
                        {{--<th>Leitura</th>--}}
                        <th>Data da Leitura</th>
                    </thead>
                    <tbody>
                        @foreach ($leituras as $lei)
                        <tr>
                            <td>{{ $lei->LEI_ID }}</td>
                            <td>{{ $lei->LEI_METRO }}</td>
                            <td>{{ $lei->LEI_LITRO }}</td>
                            <td>{{ $lei->LEI_MILILITRO }}</td>
                            {{--<td>{{ $lei->LEI_VALOR }}</td>--}}
                            <td>{{ $lei->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- fim - Histórico de Leituras -->

        <!-- Grafico -->
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-tachometer"></i> Análise gráfica</h3>
            </div>
            <div class="box-body">
                {!! $grafico->container() !!}
                {!! $grafico->script() !!}
            </div>
        </div>
        <!-- fim - Grafico -->

    </div>

    <div class="col-md-4">

        <!-- Prumadas -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-tachometer"></i> Prumadas</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            @if(count($prumadas) > 0)
                            @foreach ($prumadas as $pru)
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="info-box bg-aqua pru-box">
                                    <span class="info-box-icon"><i class="fa fa-tachometer"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Medidor #1</span>
                                        @if(isset($ultimaleitura->LEI_METRO))
                                        <span class="info-box-number">{{ sprintf("%04d", $ultimaleitura->LEI_METRO) }}</span>
                                        @else
                                        <span class="info-box-number">0000</span>
                                        @endif
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 70%"></div>
                                        </div>
                                        <span class="progress-description">
                                            @if(isset($ultimaleitura->created_at))
                                            {{ $ultimaleitura->created_at->format('d/m/Y H:i') }}
                                            @else
                                            00/00/00 - 00:00
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <p style="text-align: center;" >Não há registros.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- fim - Prumadas -->

        <!-- Histórico de consumo mensal -->
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-hourglass-1"></i> Histórico de consumo mensal</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>MÊS</th>
                                    <th>LEITURA</th>
                                </tr>

                                @foreach($consumoAnoAnterior as $key => $anoAnterior)
                                @if(($key + 1) >= date('m'))
                                @if(!empty($anoAnterior[0]))
                                <tr>
                                    <td>{{$key + 1}}/{{date("Y", strtotime('-1 year'))}}</td>
                                    <td>{{ $anoAnterior[0] }} m³</td>
                                </tr>
                                @endif
                                @endif
                                @endforeach

                                @foreach($consumoAnoAtual as $key => $anoAtual)
                                @if(!empty($anoAtual[0]))
                                <tr>
                                    <td>{{$key + 1}}/{{date('Y')}}</td>
                                    <td>{{ $anoAtual[0] }} m³</td>
                                </tr>
                                @endif
                                @if(($key + 1) == date('m'))
                                @break
                                @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- fim - Histórico de consumo mensal -->

    </div>

</div>

@stop
