@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Imóveis <small>Vizualizar Imóveis</small></h1>

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-1">
				<a href="{{ route('Buscar Imóveis') }}" class="btn btn-info"><i class="fa fa-reply"></i> Voltar</a>
			</div>
			<div class="col-md-4">
				<h4 ><i class="fa fa-building"></i> {{ $imovel->IMO_NOME }}</h4>
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
	<li><a href="imovel">Imóveis</a></li>
	<li><a href="/imovel/buscar">Buscar</a></li>
	<li class="active">Vizualizar</li>
</ol>

@stop

@section('content')

<div class="row">


	<div class="col-md-12">
		<div class="row">

			<?php // LEITURAS ?>
			<div class="col-md-8 row leitura_unidade">
				<div class="col-md-12">
					<div class="box1 box-primary">
						<div class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-th-large"></i> Leituras</h3>
							<div class="pull-right">
								<a href="{{ url('/imovel/'.$imovel->IMO_ID.'/atualizar') }}" class="btn btn-default btn-sm"><i class="fa fa-retweet"></i> Atualizar todas</a>
							</div>
						</div>
						<div class="box-body">
							@foreach ($agrupamentos as $key=>$agrupamento)

							<div class="box collapsed-box" style="border-top: 2px solid #f4f4f4;">
								<div class="box-header" data-widget="collapse" style="border-left: 4px solid #f38212">
									<h3 class="box-title" >{{ $agrupamento->AGR_NOME }}</h3>
									<div class="box-tools pull-right">

										<?php $iTotal = 0; $i1 = 0; $i0 = 0; ?>
										@if ($agrupamento->UNIDADES !== null)
										@foreach($agrupamento->UNIDADES as $unidade)
										@foreach($unidade->getPrumadas as $prumada)
										@if($unidade->getPrumadas()->count() > 0)
										<?php if($prumada->PRU_STATUS == 1){$i1++;}else {$i0++;} $iTotal++;?>
										@endif
										@endforeach
										@endforeach
										@endif

										<i class='fa fa-dashboard'></i> {{ $iTotal }}
										<i class='fa fa-circle' style='color: green;'></i> {{ $i1 }}
										<i class='fa fa-circle' style='color: red;'></i> {{ $i0 }}

									</div>
								</div>

								<div class="box-body" style="margin-top: 10px; border-left: 4px solid #f38212;">
									<div style="margin-left: -10px; margin-top: -10px; border-left: 4px solid #f5ae3d;">
										<div class="row">
											<div class="col-md-12">
												<div class="col-md-12">

													<!-- Unidade -->
													@if ($agrupamento->UNIDADES !== null)
													@foreach($agrupamento->UNIDADES as $unidade)
													@foreach($unidade->getPrumadas as $prumada)

													<div class="col-md-12">
														<div class="row">
															<div class="row">
																@if($unidade->getPrumadas()->count() > 0 )

																<!-- Nome Unidade -->
																<div class="col-md-5">
																	<h4>{{ $unidade->UNI_NOME }} <small style="color: grey;">#{{ $prumada->PRU_IDFUNCIONAL }}</small> </h4>
																</div>
																<!-- fim - Nome Unidade -->

																<!-- Consumo -->
																<div class="col-md-5 text-right">

																	<div class="col-md-4">
																		<a style="color: #ff6600; font-family: 'Orbitron', sans-serif;" href="{{ url('/unidade/ver/'.$unidade->UNI_ID) }}">
																			@if($unidade->getPrumadas()->count() > 0 && $unidade->getPrumadas()->first()->getLeituras()->count() > 0){{ $prumada->getLeituras()->orderBy('created_at', 'DESC')->first()->LEI_METRO }} @else 0 @endif
																		</a>
																		<small style="color: grey;">m³</small>
																	</div>

																	<div class="col-md-4">
																		<a style="color: #ff6600; font-family: 'Orbitron', sans-serif;" href="{{ url('/unidade/ver/'.$unidade->UNI_ID) }}">
																			@if($unidade->getPrumadas()->count() > 0 && $unidade->getPrumadas()->first()->getLeituras()->count() > 0){{ $prumada->getLeituras()->orderBy('created_at', 'DESC')->first()->LEI_LITRO }} @else 0 @endif
																		</a>
																		<small style="color: grey;">L</small>
																	</div>

																	<div class="col-md-4">
																		<a style="color: #ff6600; font-family: 'Orbitron', sans-serif;" href="{{ url('/unidade/ver/'.$unidade->UNI_ID) }}">
																			@if($unidade->getPrumadas()->count() > 0 && $unidade->getPrumadas()->first()->getLeituras()->count() > 0){{ $prumada->getLeituras()->orderBy('created_at', 'DESC')->first()->LEI_MILILITRO }} @else 0 @endif
																		</a>
																		<small style="color: grey;">dL</small>
																	</div>

																</div>
																<!-- fim - Consumo -->

																<!-- Botao Leitura -->
																<div class="col-md-1">
																	<a  href="{{ url('/imovel/'.$imovel->IMO_ID.'/leitura/'.$prumada->PRU_ID.'') }}" id="ocultar" onclick="loading()" class="btn btn-default ocultar"><i class="fa fa-retweet"></i></a>
																</div>
																<!-- fim - Botao Leitura -->

																<!-- Botao Desligar / Ligar -->
																<div class="col-md-1">
																	@is(['Administrador', 'Sindico'])

																	@if($prumada->PRU_STATUS == 1)
																	<a href="{{ url('/imovel/'.$imovel->IMO_ID.'/desligar/'.$prumada->PRU_ID.'') }}" id="ocultar" onclick="loading()" class="btn btn-danger ocultar" ><i class="fa fa-close"></i></a>
																	@else
																	<a href="{{ url('/imovel/'.$imovel->IMO_ID.'/ligar/'.$prumada->PRU_ID.'') }}" id="ocultar" onclick="loading()" class="btn btn-success ocultar" ><i class="fa fa-power-off"></i></a>
																	@endif

																	@endis
																</div>
																<!-- fim -  Botao Desligar / Ligar -->

																@endif
															</div>
														</div>
													</div>

													@endforeach
													@endforeach
													@else
													<div class="col-md-12">
														<p class="text-center">Não há registro.</p>
													</div>
													@endif
													<!-- FIM Unidade -->

												</div>
											</div>
										</div>
									</div>
								</div>
							</div>


							@endforeach
						</div>
					</div>
				</div>
			</div>
			<?php // FIM - LEITURAS ?>

			<?php // INFORMAÇÕES ?>
			<div class="col-md-4 row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-file-text-o"></i> Informações</h3>
						</div>
						<div class="box-body">
							<div class="row">

								<!-- Localização -->
								<div class="bloco-imovel-info">
									<p class="titulo"><i class="fa fa-map"></i> <b>Localização</b></p>
									<p>{{ $imovel->IMO_LOGRADOURO }}</p>
									<p>{{ $imovel->IMO_COMPLEMENTO }}</p>
									<p>{{ $imovel->IMO_IDCIDADE }} - {{ $imovel->IMO_IDESTADO }}</p>
									<p>{{ $imovel->IMO_CEP }}</p>
								</div>
								<!-- FIM - Localização -->

								<!-- Responsáveis -->
								<div class="bloco-imovel-info" style="margin-top: -15px;">
									<p class="titulo"><b><i class="fa fa-user"></i> Responsáveis</b></p>
									<pre style="border: none; background-color: white;">{!! $imovel->IMO_RESPONSAVEIS !!}</pre>
								</div>
								<!-- FIM - Responsáveis -->

								<!-- Contato -->
								<div class="bloco-imovel-info" style="margin-top: -15px;">
									<p class="titulo"><b><i class="fa fa-phone"></i> Contato</b></p>
									<pre style="border: none; background-color: white;">{!! $imovel->IMO_TELEFONES !!}</pre>
								</div>
								<!-- FIM - Contato -->

							</div>
						</div>
					</div>
				</div>
			</div>
			<?php // FIM - INFORMAÇÕES ?>

		</div>
	</div>

	<?php // GRAFICO ?>
	<div class="col-md-12">
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
	<?php // FIM - GRAFICO ?>

</div>

@stop
