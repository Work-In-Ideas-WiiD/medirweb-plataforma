@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
    <h1><i class="fa fa-institution"></i> Imóveis</h1>
@stop

@section('content')
	<div class="col-md-3">
		<div class="box box-primary">
			<div class="bloco-imovel-info">
				<h4>Filtro:</h4>
				{!! Form::open(['id' => 'filtroImoveis']) !!}
			
					<!-- Estado Imóvel -->
					<div class="form-group">
						{{ Form::label('imo_idestado', 'Estado') }}
						{{ Form::select('imo_idestado', [9 => 'Distrito Federal'], null, ['class' => 'form-control', 'placeholder' => 'Escolha um estado', 'id' => 'imo_idestado' ]) }}
					</div><!-- /.form group -->  		
				
					<!-- Cidade Imóvel -->
					<div class="form-group">
						{{ Form::label('imo_idcidade', 'Cidade') }}
						{{ Form::select('imo_idcidade', [1 => 'Brasília'], null, ['class' => 'form-control', 'placeholder' => 'Escolha uma cidade', 'id' => 'imo_idcidade']) }}
					</div><!-- /.form group --> 

					{{ Form::button('<i class="fa fa-filter"></i> Filtrar', ['class' => 'btn btn-default', 'style' => 'width: 100%;', 'id' => 'submitFiltro']) }}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
    <div class="col-md-9">
    	<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-list"></i> Listagem</h3>
				<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="row" id="resultadoPesquisa">
							<p style="text-align: center;">Sem resultados para mostrar</p>
						</div>
					</div>

				</div>
			</div><!-- /.box-body -->
			</div>
    		
		</div><!-- /.box .box-primary -->
	</div><!-- /.col-md-9 -->
@stop