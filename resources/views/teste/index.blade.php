@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}
{!! Html::style( asset('css/correct_content2.css')) !!}

@section('content')

    <div class="col-md-12">
        <div class="panel box box-primary">
            <div class="box-header with-border collaptitlr">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed" >
                    <h4 class="box-title pull-left">
                        <i class="fa fa-building"></i>
                        {{ $imovel->IMO_NOME }}
                    </h4>
                    <i class="fa fa-chevron-down pull-right"></i>
                </a>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                <div class="box-body">
                    <div class="row">

                        <!-- Infomação -->
                        <div class="col-md-4">
                            <div class="bloco-imovel-info">
                                <p class="titulo"><i class="fa fa-map"></i> <b>Localização</b></p>
                                <p>{{ $imovel->IMO_LOGRADOURO }}</p>
                                <p>{{ $imovel->IMO_COMPLEMENTO }}</p>
                                <p>{{ $imovel->IMO_IDCIDADE }} - {{ $imovel->IMO_IDESTADO }}</p>
                                <p>{{ $imovel->IMO_CEP }}</p>
                            </div>
                        </div>
                        <!-- FIM Informação -->

                        <!-- Infomação -->
                        <div class="col-md-4">
                            <div class="bloco-imovel-info">
                                <p class="titulo"><b><i class="fa fa-user"></i> Responsáveis</b></p>
                                <p>{!! $imovel->IMO_RESPONSAVEIS !!}</p>
                            </div>
                        </div>
                        <!-- FIM Informação -->

                        <!-- Infomação -->
                        <div class="col-md-4">
                            <div class="bloco-imovel-info">
                                <p class="titulo"><b><i class="fa fa-phone"></i> Contato</b></p>
                                <p>{!! $imovel->IMO_TELEFONES !!}</p>
                            </div>
                        </div>
                        <!-- FIM Informação -->

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="nav-tabs-custom">

            <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="false">Torre 1</a></li>

                <li class="pull-left header"><h4><i class="fa fa-th-large"></i> Unidades</h4></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                        <div class="row">
                            <!-- Unidade -->
                            @if ($unidades !== null)
                                @foreach($unidades as $unidade)
                                    <div class="col-md-3">
                                        <div class="leituracontainer">
                                            <div class="col col-md-6 marcacao" >
                                                <p>{!! $unidade->status == 1 ? "<i class='fa fa-circle' style='color: green;''></i>" : "<i class='fa fa-circle' style='color: red;'></i>" !!}
                                                    {{ $unidade->id }}</p>

                                            <!-- <a href="#" type="button" class="btn btn-default btn-sm" style="width: 100%; margin-bottom: 2px;">
	            						<i class="fa fa-retweet"></i> Leitura
	            					</a> -->

                                                    <a href="{{ url('/teste/ler/'.$unidade->id) }}" type="button" class="btn btn-default btn-sm" style="width: 100%; margin-bottom: 2px;">
                                                        <i class="fa fa-retweet"></i> Leitura
                                                    </a>

                                                    @if($unidade->status == 1)
                                                        <a href="{{ url('/teste/desligar/'.$unidade->id) }}" type="button" class="btn btn-danger btn-sm" style="width: 100%;" >
                                                            <i class="fa fa-close"></i> Corte
                                                        </a>
                                                    @else
                                                        <a href="{{ url('/teste/ligar/'.$unidade->id) }}" type="button" class="btn btn-success btn-sm" style="width: 100%;" >
                                                            <i class="fa fa-power-off"></i> Ativação
                                                        </a>
                                                    @endif
                                                <!-- <a type="button" class="btn btn-danger btn-sm" style="width: 100%;" >
											<i class="fa fa-close"></i> Corte
										</a> -->

                                                <p>ID: #{{ $unidade->id }}</p>

                                            </div>
                                            <div class="col col-md-6 leitura">
                                                <p class="small"><i class="fa fa-bath" aria-hidden="true"></i> Consumo - Água</p>
                                                <div class="row">
                                                    <div class="col-md-9" style="margin: 0; padding-right: 0;">
                                                        <div class="big">

                                                            <a href="#">

                                                                <p class="valor">{{ $unidade->metro }}</p>

                                                            </a>

                                                            <a href="#">

                                                                <p class="valor">{{ $unidade->litro }}</p>

                                                            </a>

                                                            <a href="#">

                                                                <p class="valor">{{ $unidade->mililitro }}</p>

                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-1" style="margin: 0; padding-left: 3px;">
                                                        <p style="line-height: 1.4em; text-decoration: none; cursor: default; color: #fff;">m³</p>
                                                        <p style="line-height: 2.0em; text-decoration: none; cursor: default; color: #fff;">L</p>
                                                        <p style="line-height: 1.0em; text-decoration: none; cursor: default; color: #fff;">dL</p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div> <!-- FIM .leituracontainer -->
                                    </div><!-- FIM .col-md-3 -->

                                    <div class="col-md-3">
                                        <div class="leituracontainer" style=" background: #35764d !important; border: 2px solid #274e34 !important;">
                                            <div class="col col-md-6 marcacao" >
                                                <p>{!! $unidade->status == 1 ? "<i class='fa fa-circle' style='color: green;''></i>" : "<i class='fa fa-circle' style='color: red;'></i>" !!}
                                                    {{ $unidade->id + 1 }}</p>

                                                <!-- <a href="#" type="button" class="btn btn-default btn-sm" style="width: 100%; margin-bottom: 2px;">
                                            <i class="fa fa-retweet"></i> Leitura
                                        </a> -->

                                                <a href="#" type="button" class="btn btn-default btn-sm" style="width: 100%; margin-bottom: 2px;">
                                                    <i class="fa fa-retweet"></i> Leitura
                                                </a>

                                                @if($unidade->status == 1)
                                                    <a href="#" type="button" class="btn btn-danger btn-sm" style="width: 100%;" >
                                                        <i class="fa fa-close"></i> Corte
                                                    </a>
                                                @else
                                                    <a href="#" type="button" class="btn btn-success btn-sm" style="width: 100%;" >
                                                        <i class="fa fa-power-off"></i> Ativação
                                                    </a>
                                            @endif
                                            <!-- <a type="button" class="btn btn-danger btn-sm" style="width: 100%;" >
											<i class="fa fa-close"></i> Corte
										</a> -->

                                                <p>ID: #4</p>

                                            </div>
                                            <div class="col col-md-6 leitura">
                                                <p class="small"><i class="fa fa-fire" aria-hidden="true"></i> Consumo - Gás</p>
                                                <div class="row">
                                                    <div class="col-md-9" style="margin: 0; padding-right: 0;">
                                                        <div class="big">

                                                            <a href="#">

                                                                <p class="valor">{{ $unidade->metro }}</p>

                                                            </a>

                                                            <a href="#">

                                                                <p class="valor">{{ $unidade->litro }}</p>

                                                            </a>

                                                            <a href="#">

                                                                <p class="valor">{{ $unidade->mililitro }}</p>

                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-1" style="margin: 0; padding-left: 3px;">
                                                        <p style="line-height: 1.4em; text-decoration: none; cursor: default; color: #fff;">m³</p>
                                                        <p style="line-height: 2.0em; text-decoration: none; cursor: default; color: #fff;">L</p>
                                                        <p style="line-height: 1.0em; text-decoration: none; cursor: default; color: #fff;">dL</p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div> <!-- FIM .leituracontainer -->
                                    </div><!-- FIM .col-md-3 -->

                                    <div class="col-md-3">
                                        <div class="leituracontainer" style=" background: #8b0000 !important; border: 2px solid #79291b !important;">
                                            <div class="col col-md-6 marcacao" >
                                                <p>{!! $unidade->status == 1 ? "<i class='fa fa-circle' style='color: green;''></i>" : "<i class='fa fa-circle' style='color: red;'></i>" !!}
                                                    {{ $unidade->id + 2 }}</p>

                                                <!-- <a href="#" type="button" class="btn btn-default btn-sm" style="width: 100%; margin-bottom: 2px;">
                                            <i class="fa fa-retweet"></i> Leitura
                                        </a> -->

                                                <a href="#" type="button" class="btn btn-default btn-sm" style="width: 100%; margin-bottom: 2px;">
                                                    <i class="fa fa-retweet"></i> Leitura
                                                </a>

                                                @if($unidade->status == 1)
                                                    <a href="#" type="button" class="btn btn-danger btn-sm" style="width: 100%;" >
                                                        <i class="fa fa-close"></i> Corte
                                                    </a>
                                                @else
                                                    <a href="#" type="button" class="btn btn-success btn-sm" style="width: 100%;" >
                                                        <i class="fa fa-power-off"></i> Ativação
                                                    </a>
                                            @endif
                                            <!-- <a type="button" class="btn btn-danger btn-sm" style="width: 100%;" >
											<i class="fa fa-close"></i> Corte
										</a> -->

                                                <p>ID: #5</p>

                                            </div>
                                            <div class="col col-md-6 leitura">
                                                <p class="small"><i class="fa fa-bolt" aria-hidden="true"></i> Consumo - Energia</p>
                                                <div class="row">
                                                    <div class="col-md-9" style="margin: 0; padding-right: 0;">
                                                        <div class="big">

                                                            <a href="#">

                                                                <p class="valor">{{ $unidade->metro }}</p>

                                                            </a>

                                                            <a href="#">

                                                                <p class="valor">{{ $unidade->litro }}</p>

                                                            </a>

                                                            {{--<a href="#">--}}

                                                                {{--<p class="valor">{{ $unidade->mililitro }}</p>--}}

                                                            {{--</a>--}}

                                                        </div>
                                                    </div>
                                                    <div class="col-md-1" style="margin: 0; padding-left: 3px;">
                                                        <p style="line-height: 1.4em; text-decoration: none; cursor: default; color: #fff;">MWh</p>
                                                        <p style="line-height: 2.0em; text-decoration: none; cursor: default; color: #fff;">Kwh</p>
                                                        {{--<p style="line-height: 1.0em; text-decoration: none; cursor: default; color: #fff;">dL</p>--}}
                                                    </div>
                                                </div>

                                            </div>
                                        </div> <!-- FIM .leituracontainer -->
                                    </div><!-- FIM .col-md-3 -->
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <p class="text-center">Não há registro.</p>
                                </div>
                        @endif
                        <!-- FIM Unidade -->

                        </div> <!-- FIM .row -->
                </div> <!-- FIM .tab-pane -->
            </div> <!-- FIM .tab-content -->


        </div> <!-- FIM .nav-tabs-custom -->
    </div><!-- FIM .col-md-12 -->

@stop