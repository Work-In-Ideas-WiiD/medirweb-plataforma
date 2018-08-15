@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

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
						<p>{{ $imovel->IMO_ENDERECO }}</p>
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
            	@foreach ($agrupamentos as $key=>$agrupamento)
              		<li class="{{ $loop->first ? 'active' : '' }}"><a href="#tab_{{ $key }}-{{ $key }}" data-toggle="tab" aria-expanded="false">{{ $agrupamento->AGR_NOME }}</a></li>
            	 @endforeach

              	<li class="pull-left header"><h4><i class="fa fa-th-large"></i> Unidades<h4></li>
            </ul>

            <div class="tab-content">

              @for ($i = 0; $i < count($agrupamentos); $i++)
              <div class="tab-pane active" id="tab_{{ $i }}-{{ $i }}">
                <div class="row">

                	<!-- Unidade -->
                	 @foreach($unidades as $unidade)
						 <?php var_dump($unidade->getPrumadas()->count());	 ?>
                	<div class="col-md-3">
                		<div class="leituracontainer">
                			<div class="col col-md-6 marcacao" >
            					<p>{{ $unidade->UNI_NOME }}</p>
            					<button type="button" class="btn btn-default">
            						<i class="fa fa-download"></i>
            					</button>

								<button type="button" class="btn btn-danger">
            						<i class="fa fa-close"></i>
            					</button>
            				</div>
            				<div class="col col-md-6 leitura">
                				<p class="small">Consumo</p>
                				<div class="big">
                					<a href="{{ url('/unidade/ver/'.$unidade->UNI_ID) }}"><p class="valor">@if($unidade->getPrumadas()->count() > 0 ){{ $unidade->getPrumadas()->first()->getLeituras()->orderBy('created_at', 'DESC')->first()->LEI_METRO }} @else 100 @endif</p></a>
                				</div>
            				</div>
                		</div> <!-- FIM .leituracontainer -->
                	</div><!-- FIM .col-md-3 -->
                	 @endforeach
                	<!-- FIM Unidade -->

                </div> <!-- FIM .row -->
              </div> <!-- FIM .tab-pane -->
              @endfor

            </div> <!-- FIM .tab-content -->


		</div> <!-- FIM .nav-tabs-custom -->
	</div><!-- FIM .col-md-12 -->
	
@stop