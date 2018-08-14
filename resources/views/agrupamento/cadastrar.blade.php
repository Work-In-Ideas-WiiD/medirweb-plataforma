@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
    <h1><i class="fa fa-building"></i> Agrupamentos</h1>
@stop

@section('content')
	<div class="col-md-3">
		<div class="box box-primary">
			<p class="bloco-imovel-cad">
				<i class="fa fa-institution"></i>
			</p>
			<p style="text-align: center; padding-bottom: 12px;" >Novo Agrupamento</p>
		</div>
	</div>
    <div class="col-md-9">
    	<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-plus"></i> Adicionar</h3>
			</div>
    		{!! Form::open(['action' => 'AgrupamentoController@store', 'method' => 'POST']) !!}
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<!-- Estado Agrupamento -->
						<div class="form-group">
							 {{ Form::label('AGR_IDESTADO', 'Estado') }}
							 {{ Form::select('AGR_IDESTADO', [9 => 'Goiás'], null, ['class' => 'form-control', 'placeholder' => 'Escolha um estado']) }}
						</div><!-- /.form group -->
						<!-- Imóvel Agrupamento -->
						<div class="form-group">
							 {{ Form::label('AGR_IDIMOVEL', 'Imóvel') }}
							 {{ Form::select('AGR_IDIMOVEL', $imoveis, null, ['class' => 'form-control', 'placeholder' => 'Escolha um imóvel']) }}
						</div><!-- /.form group --> 
					</div>

					<div class="col-md-6">
						<!-- Cidade Agrupamento -->
						<div class="form-group">
							 {{ Form::label('AGR_IDCIDADE', 'Cidade') }}
							 {{ Form::select('AGR_IDCIDADE', [1 => 'Goiânia'], null, ['class' => 'form-control', 'placeholder' => 'Escolha uma cidade']) }}
						</div><!-- /.form group --> 
						<!-- Nome Agrupamento -->
						<div class="form-group">
							 {{ Form::label('AGR_NOME', 'Nome') }}
		      				 {{ Form::text('AGR_NOME', '', ['class' => 'form-control', 'placeholder' => 'Ex.: Torre L']) }}
						</div><!-- /.form group -->
					</div>

				</div>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<a href="{{ url()->previous() }}" class="btn btn-default pull-left">Cancelar</a>
				{{ Form::submit('Adicionar Agrupamento', ['class' => 'btn btn-primary pull-right']) }}
			</div><!-- /.box-footer -->
			{!! Form::close() !!}
		</div><!-- /.box .box-primary -->
	</div><!-- /.col-md-9 -->
@stop