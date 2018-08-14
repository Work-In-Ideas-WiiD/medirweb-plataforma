@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
    <h1><i class="fa fa-building"></i> Imóveis</h1>
@stop

@section('content')
	<div class="col-md-3">
		<div class="box box-primary">
			<p class="bloco-imovel-cad">
				<i class="fa fa-institution"></i>
			</p>
			<p style="text-align: center; padding-bottom: 12px;" >Novo Imóvel</p>
		</div>
	</div>
    <div class="col-md-9">
    	<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-plus"></i> Adicionar</h3>
			</div>
    		{!! Form::open(['action' => 'ImovelController@store', 'method' => 'POST']) !!}
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<!-- Nome Imóvel -->
						<div class="form-group">
							 {{ Form::label('imo_nome', 'Nome') }}
		      				 {{ Form::text('imo_nome', '', ['class' => 'form-control', 'placeholder' => 'Ex.: Condomínio Residencial A']) }}
						</div><!-- /.form group -->
						<!-- Endereço Imóvel -->
						<div class="form-group">
							 {{ Form::label('imo_endereco', 'Endereço') }}
		      				 {{ Form::text('imo_endereco', '', ['class' => 'form-control', 'placeholder' => 'Ex.: Rua AB']) }}
						</div><!-- /.form group --> 
						<!-- Complemento Imóvel -->
						<div class="form-group">
							 {{ Form::label('imo_complemento', 'Complemento') }}
		      				 {{ Form::text('imo_complemento', '', ['class' => 'form-control', 'placeholder' => 'Ex.: Quadra X, Lote Y']) }}
						</div><!-- /.form group --> 
						<!-- Número Imóvel -->
						<div class="form-group">
							 {{ Form::label('imo_numero', 'Número') }}
		      				 {{ Form::text('imo_numero', '', ['class' => 'form-control', 'placeholder' => 'Ex.: Nº 1']) }}
						</div><!-- /.form group -->
						<!-- Responsáveis Imóvel -->
						<div class="form-group">
							 {{ Form::label('imo_responsaveis', 'Responsáveis') }}
		      				 {{ Form::textarea('imo_responsaveis', '', ['class' => 'form-control', 'rows' => 4]) }}
						</div><!-- /.form group -->
					</div>

					<div class="col-md-6">
						<!-- Bairro Imóvel -->
						<div class="form-group">
							 {{ Form::label('imo_cep', 'CEP') }}
		      				 {{ Form::text('imo_cep', '', ['class' => 'form-control', 'placeholder' => 'Ex.: 74000-000']) }}
						</div><!-- /.form group --> 
						<!-- Bairro Imóvel -->
						<div class="form-group">
							 {{ Form::label('imo_bairro', 'Bairro') }}
		      				 {{ Form::text('imo_bairro', '', ['class' => 'form-control', 'placeholder' => 'Ex.: Setor Zero']) }}
						</div><!-- /.form group -->  
						<!-- Estado Imóvel -->
						<div class="form-group">
							 {{ Form::label('imo_idestado', 'Estado') }}
							 {{ Form::select('imo_idestado', [9 => 'Goiás'], null, ['class' => 'form-control', 'placeholder' => 'Escolha um estado']) }}
						</div><!-- /.form group -->  		
						<!-- Cidade Imóvel -->
						<div class="form-group">
							 {{ Form::label('imo_idcidade', 'Cidade') }}
							 {{ Form::select('imo_idcidade', [1 => 'Goiânia'], null, ['class' => 'form-control', 'placeholder' => 'Escolha uma cidade']) }}
						</div><!-- /.form group --> 
						<!-- Responsáveis Imóvel -->
						<div class="form-group">
							 {{ Form::label('imo_telefones', 'Telefones') }}
		      				 {{ Form::textarea('imo_telefones', '', ['class' => 'form-control', 'rows' => 4]) }}
						</div><!-- /.form group -->
					</div>

				</div>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<a href="{{ url()->previous() }}" class="btn btn-default pull-left">Cancelar</a>
				{{ Form::submit('Adicionar Imóvel', ['class' => 'btn btn-primary pull-right']) }}
			</div><!-- /.box-footer -->
			{!! Form::close() !!}
		</div><!-- /.box .box-primary -->
	</div><!-- /.col-md-9 -->
@stop