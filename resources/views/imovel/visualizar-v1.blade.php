@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
    <h1><i class="fa fa-building"></i> {{ $imovel->IMO_NOME }}</h1>
@stop

@section('content')
	<div class="col-md-3">
		<div class="box box-primary">
			<p class="bloco-imovel-cad">
				<i class="fa fa-institution"></i>
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
				<p style="margin-top: 0.8em;"><a class="btn btn-flat btn-default" href="{{ route('imovel.edit', ['user' => $imovel->IMO_ID]) }}" alt="Adicionar Agrupamento" style="width: 100%;" ><i class="fa fa-edit"></i> Editar informações</a></p>
			</div>
		</div>
	</div>
    <div class="col-md-9">
    	<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-building"></i> Agrupamentos</h3>
			</div>
    		{!! Form::open(['action' => 'ImovelController@store', 'method' => 'POST']) !!}
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							@foreach ($agrupamentos as $agrupamento)
    							<div class="col-md-4 agrupamento">
    								<a href="{{ url('agrupamento/ver/') }}/{{ $agrupamento->AGR_ID }}" alt="{{ $agrupamento->AGR_NOME }}" >
    								<p class="bloco-agrupamento-vis">
										<i class="fa fa-building"></i>
										<p style="">{{ $agrupamento->AGR_NOME }}</p>
									</p>
									</a>
    							</div>
							@endforeach
						</div>
					</div>

				</div>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<a class="btn btn-primary pull-right" href="{{ url('agrupamento/adicionar') }}" alt="Adicionar Agrupamento" >Adicionar Agrupamento</a>
			</div><!-- /.box-footer -->
		</div><!-- /.box .box-primary -->
	</div><!-- /.col-md-9 -->
@stop