@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Imóveis <small>Vizualizar Imóveis</small></h1>
<ol class="breadcrumb">
	<li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="imovel">Imóveis</a></li>
	<li><a href="/imovel/buscar">Buscar</a></li>
	<li class="active">Vizualizar</li>
</ol>

@stop

@section('content')

<div id="loading" class="loading text-center oculto">
	<div class="col-md-12">
		<div class="col-md-1">
			<div class="square">
			</div>
		</div>
		<div class="col-md-11">
			<h2>Requisição sendo realizada...</h2>
			<h2>Comunicando com o servidor...</h2>
			<h5 id="aguarde"></h5>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="row">

			<div class="col-md-11">
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
										<pre style="border: none; background-color: white;">{!! $imovel->IMO_RESPONSAVEIS !!}</pre>
									</div>
								</div>
								<!-- FIM Informação -->

								<!-- Infomação -->
								<div class="col-md-4">
									<div class="bloco-imovel-info">
										<p class="titulo"><b><i class="fa fa-phone"></i> Contato</b></p>
										<pre style="border: none; background-color: white;">{!! $imovel->IMO_TELEFONES !!}</pre>
									</div>
								</div>
								<!-- FIM Informação -->

							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Botao Voltar -->
			<div class="col-md-1">
				<div class="row">
					<a href="{{ route('Buscar Imóveis') }}" class="btn btn-block btn-danger"><i class="fa fa-reply"></i> Voltar</a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="nav-tabs-custom">

			<ul class="nav nav-tabs pull-right">
				@foreach ($agrupamentos as $key=>$agrupamento)
				<li class="{{ $loop->last ? 'active' : '' }}"><a href="#tab_{{ $key }}-{{ $key }}" data-toggle="tab" aria-expanded="false">{{ $agrupamento->AGR_NOME }}</a></li>
				@endforeach

				<li class="pull-left header"><h4><i class="fa fa-th-large"></i> Unidades <a href="{{ url('/imovel/'.$imovel->IMO_ID.'/atualizar') }}" class="btn btn-default btn-sm"><i class="fa fa-retweet"></i> Atualizar todas</a><h4></li>
				</ul>

				<div class="tab-content">

					@foreach($agrupamentos as $i=>$agrupamento)
					<div class="tab-pane {{ $loop->last ? 'active' : '' }}" id="tab_{{ $i }}-{{ $i }}">
						<div class="row">

							<!-- Unidade -->
							@if ($agrupamento->UNIDADES !== null)
							@foreach($agrupamento->UNIDADES as $unidade)
							@foreach($unidade->getPrumadas as $prumada)

							<div class="col-md-3">
								<div class="leituracontainer">
									<div class="col col-md-6 marcacao" >
										<p>@if($unidade->getPrumadas()->count() > 0) {!! $prumada->PRU_STATUS == 1 ? "<i class='fa fa-circle' style='color: green;'></i>" : "<i class='fa fa-circle' style='color: red;'></i>" !!} @endif
											{{ $unidade->UNI_NOME }}</p>

											<!-- <a href="{{ url('/imovel/'.$imovel->IMO_ID.'/leitura/'.$unidade->UNI_ID.'') }}" type="button" class="btn btn-default btn-sm" style="width: 100%; margin-bottom: 2px;">
											<i class="fa fa-retweet"></i> Leitura
										</a> -->

										@if($unidade->getPrumadas()->count() > 0)

										<a  href="{{ url('/imovel/'.$imovel->IMO_ID.'/leitura/'.$prumada->PRU_ID.'') }}" id="ocultar" onclick="loading()"  type="button" class="btn btn-default btn-sm ocultar" style="width: 100%; margin-bottom: 2px;">
											<i class="fa fa-retweet"></i> Leitura
										</a>

										@is(['Administrador', 'Sindico'])
										@if($prumada->PRU_STATUS == 1)
										<a href="{{ url('/imovel/'.$imovel->IMO_ID.'/desligar/'.$prumada->PRU_ID.'') }}" id="ocultar" onclick="loading()" type="button" class="btn btn-danger btn-sm ocultar" style="width: 100%;" >
											<i class="fa fa-close"></i> Corte
										</a>
										@else
										<a href="{{ url('/imovel/'.$imovel->IMO_ID.'/ligar/'.$prumada->PRU_ID.'') }}" id="ocultar" onclick="loading()" type="button" class="btn btn-success btn-sm ocultar" style="width: 100%;" >
											<i class="fa fa-power-off"></i> Ativação
										</a>
										@endif
										@endis
										@else
										<!-- <a type="button" class="btn btn-danger btn-sm" style="width: 100%;" >
										<i class="fa fa-close"></i> Corte
									</a> -->
									@endif
									@if($unidade->getPrumadas()->count() > 0 )
									<p>ID: #{{ $prumada->PRU_IDFUNCIONAL }}</p>
									@endif
								</div>
								<div class="col col-md-6 leitura">
									<p class="small">Consumo</p>
									<div class="row">
										<div class="col-md-9" style="margin: 0; padding-right: 0;">
											<div class="big">

												<a href="{{ url('/unidade/ver/'.$unidade->UNI_ID) }}">

													<p class="valor">@if($unidade->getPrumadas()->count() > 0 && $unidade->getPrumadas()->first()->getLeituras()->count() > 0){{ $prumada->getLeituras()->orderBy('created_at', 'DESC')->first()->LEI_METRO }} @else 0 @endif</p>

												</a>

												<a href="{{ url('/unidade/ver/'.$unidade->UNI_ID) }}">

													<p class="valor">@if($unidade->getPrumadas()->count() > 0 && $unidade->getPrumadas()->first()->getLeituras()->count() > 0){{ $prumada->getLeituras()->orderBy('created_at', 'DESC')->first()->LEI_LITRO }} @else 0 @endif</p>

												</a>

												<a href="{{ url('/unidade/ver/'.$unidade->UNI_ID) }}">

													<p class="valor">@if($unidade->getPrumadas()->count() > 0 && $unidade->getPrumadas()->first()->getLeituras()->count() > 0){{ $prumada->getLeituras()->orderBy('created_at', 'DESC')->first()->LEI_MILILITRO }} @else 0 @endif</p>

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
						@endforeach
						@else
						<div class="col-md-12">
							<p class="text-center">Não há registro.</p>
						</div>
						@endif
						<!-- FIM Unidade -->

					</div> <!-- FIM .row -->
				</div> <!-- FIM .tab-pane -->
				@endforeach

			</div> <!-- FIM .tab-content -->


		</div> <!-- FIM .nav-tabs-custom -->

		<?php // GRAFICO ?>
		<div class="col-md-12">
			<div class="row">
				<div class="form-group">
					<div class="box box-primary collapse-box">
						<div class="box-header with-border gray" style="background-color: #3c8dbc; color: white; text-align: center;">
							<h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"></i> GRAFICO</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
							</div>
						</div>
						<div class='box-body' style="text-align: center;">
							<div class="col-md-12">
								{!! $chartConsumoLine->container() !!}
								{!! $chartConsumoLine->script() !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php // FIM - GRAFICO ?>

	</div><!-- FIM .col-md-12 -->
</div>

@stop
