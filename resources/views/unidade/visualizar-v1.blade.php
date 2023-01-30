@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1><i class="fa fa-building"></i> <a href="{{ url('imovel/ver') }}/{{ $imovel->IMO_ID }}" alt="{{ $imovel->IMO_NOME }}" class="linkbread" >{{ $imovel->IMO_NOME }}</a> <i class="fa fa-angle-right"></i> <a href="{{ url('agrupamento/ver') }}/{{ $agrupamento->AGR_ID }}" alt="{{ $agrupamento->AGR_NOME }}" class="linkbread" >{{ $agrupamento->AGR_NOME }}</a> <i class="fa fa-angle-right"></i> {{ $unidade->UNI_NOME }}</h1>
@stop

@section('content')
<div class="col-md-3 row">

    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-tachometer"></i> Indicador atual <i class="fa fa-circle" style="color: #009900;"></i></h3>
            </div>
            <div class="bloco-medicao">
                @if(isset($ultimaleitura->LEI_METRO))
                <p class="registronum" >{{ sprintf("%04d", $ultimaleitura->LEI_METRO) }} <span class="unidade" >m³</span></p>
                @else
                <p class="registronum" >0000 <span class="unidade" >m³</span></p>
                @endif
                <!--<p style="margin-top: 0.8em;"><a class="btn btn-flat btn-default" href="" alt="Adicionar Agrupamento" style="width: 100%;" ><i class="fa fa-edit"></i> Editar informações</a></p>-->
            </div>
            <div class="box-footer">
                @if(isset($ultimaleitura->LEI_METRO))
                <p class="pull-right" style="margin-bottom: 0;" >Consumo do mês corrente: <b>{{ $ultimaleitura->LEI_METRO }}</b>m³</p>
                @else
                <p class="pull-right" style="margin-bottom: 0;" >Consumo do mês corrente: <b>0000</b>m³</p>
                @endif

            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="box box-primary">
            <p class="bloco-imovel-cad">
                <i class="fa fa-building agr"></i>
            </p>
            <div class="bloco-imovel-info">
                <p class="titulo"><i class="fa fa-map"></i> <b>Localização</b></p>
                <p>{{ $imovel->IMO_ENDERECO }}</p>
                <p>{{ $imovel->IMO_COMPLEMENTO }}</p>
                <p>{{ $imovel->IMO_IDCIDADE }} - {{ $imovel->IMO_IDESTADO }}</p>
                <p>{{ $imovel->IMO_CEP }}</p>
                <p class="titulo"><b><i class="fa fa-user"></i> Responsáveis</b></p>
                <p>{!! $imovel->IMO_RESPONSAVEIS !!}</p>
                <p class="titulo"><b><i class="fa fa-phone"></i> Contato</b></p>
                <p>{!! $imovel->IMO_TELEFONES !!}</p>
                <!--<p style="margin-top: 0.8em;"><a class="btn btn-flat btn-default" href="" alt="Adicionar Agrupamento" style="width: 100%;" ><i class="fa fa-edit"></i> Editar informações</a></p>-->
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="box box-success">
            <p class="bloco-imovel-cad">
                <i class="fa fa-user uni"></i>
            </p>
            <div class="bloco-imovel-info">
                <p class="titulo"><i class="fa fa-user"></i> <b>Responsável</b></p>
                <p>{{ $unidade->UNI_RESPONSAVEL }}</p>
                <p>{{ $unidade->UNI_CPFRESPONSAVEL }}</p>
                <p>{{ $unidade->UNI_TELRESPONSAVEL }}</p>
            </div>
        </div>
    </div>

</div>
<div class="col-md-9 row">
    <div class="col-md-12">
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
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="info-box bg-aqua pru-box">
                                    <span class="info-box-icon"><i class="fa fa-tachometer"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Medidor #1</span>
                                        @if(isset($ultimaleitura->LEI_VALOR))
                                        <span class="info-box-number">{{ sprintf("%04d", $ultimaleitura->LEI_VALOR) }}</span>
                                        @else
                                        <span class="info-box-number">00000000</span>
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
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
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
    </div>

    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-tachometer"></i> Leituras</h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive table-bordered" id="tabelaPrincipal">
                    <thead>
                        <th>#</th>
                        <th>ID Funcional</th>
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
                            <td>{{ $lei->LEI_IDPRUMADA }}</td>
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
    </div>

    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-tachometer"></i> Análise gráfica</h3>
            </div>
            <div class="box-body">
                <canvas id="grafico" style="width: 100%; height: 23.5rem;"></canvas>
            </div>
        </div>
    </div>

</div><!-- /.col-md-9 -->

@stop
