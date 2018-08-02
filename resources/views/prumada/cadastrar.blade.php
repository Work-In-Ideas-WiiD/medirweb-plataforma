@extends('adminlte::page')

@section('title', 'AdminLTE')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
    <h1><i class="fa fa-building"></i> Prumadas</h1>
@stop

@section('content')
	<div class="col-md-3">
		<div class="box box-primary">
			<p class="bloco-imovel-cad">
				<i class="fa fa-tachometer"></i>
			</p>
			<p style="text-align: center; padding-bottom: 12px;" >Nova Prumada</p>
		</div>
	</div>
    <div class="col-md-9">
    	<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-plus"></i> Adicionar</h3>
			</div>
    		{!! Form::open(['action' => 'PrumadaController@store', 'method' => 'POST']) !!}
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<!-- Unidade Prumada -->
						<div class="form-group">
							 {{ Form::label('PRU_IDUNIDADE', 'Unidade') }}
		      				 {{ Form::text('PRU_IDUNIDADE', '', ['class' => 'form-control', 'placeholder' => 'Ex.: 1']) }}
						</div><!-- /.form group -->
						<!-- Cidade Prumada -->
						<div class="form-group">
							 {{ Form::label('PRU_STATUS', 'Status') }}
							 {{ Form::select('PRU_STATUS', [1 => 'Ativo', 0 => 'Inativo'], null, ['class' => 'form-control']) }}
						</div><!-- /.form group -->
					</div>

					<div class="col-md-6">					
						<!-- ID Funcional Prumada -->
						<div class="form-group">
							 {{ Form::label('PRU_IDFUNCIONAL', 'ID Funcional') }}
		      				 {{ Form::text('PRU_IDFUNCIONAL', '', ['class' => 'form-control', 'placeholder' => 'Ex.: 148597']) }}
						</div><!-- /.form group -->
					</div>

				</div>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<a href="{{ url()->previous() }}" class="btn btn-default pull-left">Cancelar</a>
				{{ Form::submit('Adicionar Prumada', ['class' => 'btn btn-primary pull-right']) }}
			</div><!-- /.box-footer -->
			{!! Form::close() !!}
		</div><!-- /.box .box-primary -->
	</div><!-- /.col-md-9 -->
@stop