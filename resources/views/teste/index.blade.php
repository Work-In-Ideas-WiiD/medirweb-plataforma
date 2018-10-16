@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}
{!! Html::style( asset('css/correct_content2.css')) !!}

@section('content')

    <div class="col-md-12">
        <div class="nav-tabs-custom">

            <ul class="nav nav-tabs pull-right">
                <li class="pull-left header"><h4><i class="fa fa-th-large"></i> Unidades</h4></li>
            </ul>

            <div class="tab-content">
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

                                                    <a href="{{ url('/teste/ler') }}" type="button" class="btn btn-default btn-sm" style="width: 100%; margin-bottom: 2px;">
                                                        <i class="fa fa-retweet"></i> Leitura
                                                    </a>

                                                    @if($unidade->status == 1)
                                                        <a href="{{ url('/teste/desligar') }}" type="button" class="btn btn-danger btn-sm" style="width: 100%;" >
                                                            <i class="fa fa-close"></i> Corte
                                                        </a>
                                                    @else
                                                        <a href="{{ url('/teste/ligar') }}" type="button" class="btn btn-success btn-sm" style="width: 100%;" >
                                                            <i class="fa fa-power-off"></i> Ativação
                                                        </a>
                                                    @endif
                                                <!-- <a type="button" class="btn btn-danger btn-sm" style="width: 100%;" >
											<i class="fa fa-close"></i> Corte
										</a> -->

                                                <p>ID: #{{ $unidade->id }}</p>

                                            </div>
                                            <div class="col col-md-6 leitura">
                                                <p class="small">Consumo</p>
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
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <p class="text-center">Não há registro.</p>
                                </div>
                        @endif
                        <!-- FIM Unidade -->

                        </div> <!-- FIM .row -->
            </div> <!-- FIM .tab-content -->


        </div> <!-- FIM .nav-tabs-custom -->
    </div><!-- FIM .col-md-12 -->

@stop