@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<div class="col-md-4">
	<div class="row" style="margin-top: -15px">
		<h3>Imóveis <small>Seus imóveis</small></h3>
	</div>
</div>
<div class="col-md-8">
	<div id="loading" class="loading oculto">
		<div style="margin-top:10px;">
			<div class="carregar"></div>
			<p style="margin-top:-20px; color:red;">&emsp;&emsp;Requisição em andamento. <font color="red" id="aguarde"></font></p>
		</div>
	</div>
</div>

<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="#">Imóveis</a></li>
	<li class="active">Buscar imóveis</li>
</ol>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-filter"></i> Filtro:</h3>
			</div>
			<div class="box-body">
				{!! Form::open(['id' => 'filtroImoveis']) !!}
				<div class="row">
					<div class="col-md-4">
						<!-- Estado Imóvel -->
						<div class="form-group">
							{{ Form::label('IMO_IDESTADO', 'Estado') }}
							{{ Form::select('IMO_IDESTADO', $estados, null, ['class' => 'form-control chosen-select-IMO_IDESTADO', 'placeholder' => 'Escolha um estado', 'id' => 'IMO_IDESTADO' ]) }}
						</div><!-- /.form group -->
					</div>

					<div class="col-md-4">
						<!-- Cidade Imóvel -->
						<div class="form-group">
							{{ Form::label('IMO_IDCIDADE', 'Cidade') }}
							{{ Form::select('IMO_IDCIDADE', ['' => 'Selecionar Cidade'], null, ['class' => 'form-control chosen-select-IMO_IDCIDADE', 'placeholder' => 'Escolha uma cidade', 'id' => 'IMO_IDCIDADE']) }}
						</div><!-- /.form group -->
					</div>

					<div class="col-md-4">
						<!-- Botão Imóvel -->
						<div class="form-group">
							{{ Form::label('', '&nbsp;') }}
							{{ Form::button('<i class="fa fa-filter"></i> Filtrar', ['class' => 'btn btn-default', 'style' => 'width: 100%;', 'id' => 'submitFiltro']) }}
						</div>
					</div>
				</div>
				{!! Form::close() !!}
			</div>

		</div>
	</div>
	<div class="col-md-12">
		<div class="row" id="resultadoPesquisa">
			<p style="text-align: center;">Sem resultados para mostrar</p>
		</div>
	</div>
</div>
@stop
