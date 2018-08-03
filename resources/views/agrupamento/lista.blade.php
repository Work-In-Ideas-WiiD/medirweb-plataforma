@extends('adminlte::page')

@section('title', 'AdminLTE')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
    <h1><i class="fa fa-building"></i> <a href="{{ url('imovel/ver') }}/{{ $imovel->IMO_ID }}" alt="{{ $imovel->IMO_NOME }}" class="linkbread" >{{ $imovel->IMO_NOME }}</a> <i class="fa fa-angle-right"></i> {{ $agrupamento->AGR_NOME }}</h1>
@stop

@section('content')
	<div class="row">
	<div class="col-md-3">
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
    <div class="col-md-9">
    	<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-building"></i> Unidades</h3>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							@if(count($unidades) > 0)
								@foreach ($unidades as $uni)
	    							<div class="col-md-2 unidade imolista">
	    								<a href="{{ url('unidade/ver/') }}/{{ $uni->UNI_ID }}" alt="{{ $uni->UNI_NOME }}" >
	    								<div class="bloco-agrupamento-vis">
											<i class="fa fa-th-large uni"></i>
											<p class="imo">{{ $uni->UNI_NOME }}</p>
											<p class="imo imobairro"><i class="fa fa-user ext"></i> {{ $uni->UNI_RESPONSAVEL }}</p>
											<p class="imo imobairro"><i class="fa fa-drivers-license-o ext"></i> {{ $uni->UNI_CPFRESPONSAVEL }}</p>
										</div>
										</a>
	    							</div>
								@endforeach
							@else
								<p style="text-align: center;" >Não há registros.</p>
							@endif
						</div>
					</div>

				</div>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<a class="btn btn-primary pull-right" href="{{ url('unidade/adicionar') }}" alt="Adicionar Unidade" >Adicionar Unidade</a>
			</div><!-- /.box-footer -->
		</div><!-- /.box .box-primary -->
	</div><!-- /.col-md-9 -->
	</div>
@stop