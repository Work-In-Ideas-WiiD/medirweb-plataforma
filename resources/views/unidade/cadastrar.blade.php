@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
    <h1><i class="fa fa-th-large"></i> Unidades</h1>
@stop

@section('content')
	<div class="col-md-3">
		<div class="box box-primary">
			<p class="bloco-imovel-cad">
				<i class="fa fa-th-large"></i>
			</p>
			<p style="text-align: center; padding-bottom: 12px;" >Nova Unidade</p>
		</div>
	</div>
    <div class="col-md-9">
    	<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-plus"></i> Adicionar</h3>
			</div>
    		{!! Form::open(['action' => 'UnidadeController@store', 'method' => 'POST']) !!}
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<!-- Estado Unidade -->
						<div class="form-group">
							 {{ Form::label('UNI_IDESTADO', 'Estado') }}
							 {{ Form::select('UNI_IDESTADO', [9 => 'Goiás'], null, ['class' => 'form-control', 'placeholder' => 'Escolha um estado']) }}
						</div><!-- /.form group -->
						<!-- Imóvel Unidade -->
						<div class="form-group">
							 {{ Form::label('UNI_IDIMOVEL', 'Imóvel') }}
							 {{ Form::select('UNI_IDIMOVEL', [1 => 'Condomínio Residencial Maranata'], null, ['class' => 'form-control', 'placeholder' => 'Escolha um imóvel']) }}
						</div><!-- /.form group --> 
						<!-- Nome Unidade -->
						<div class="form-group">
							 {{ Form::label('UNI_NOME', 'Nome') }}
		      				 {{ Form::text('UNI_NOME', '', ['class' => 'form-control', 'placeholder' => 'Ex.: 1004']) }}
						</div><!-- /.form group -->
						<!-- CPF Responsável Unidade -->
						<div class="form-group">
							 {{ Form::label('UNI_CPFRESPONSAVEL', 'CPF do Responsável') }}
		      				 {{ Form::text('UNI_CPFRESPONSAVEL', '', ['class' => 'form-control', 'placeholder' => 'Ex.: 111.111.111.-44']) }}
						</div><!-- /.form group -->
					</div>

					<div class="col-md-6">
						<!-- Cidade Unidade -->
						<div class="form-group">
							 {{ Form::label('UNI_IDCIDADE', 'Cidade') }}
							 {{ Form::select('UNI_IDCIDADE', [1 => 'Goiânia'], null, ['class' => 'form-control', 'placeholder' => 'Escolha uma cidade']) }}
						</div><!-- /.form group --> 
						<div class="form-group">
							 {{ Form::label('UNI_IDAGRUPAMENTO', 'Agrupamento') }}
							 {{ Form::select('UNI_IDAGRUPAMENTO', $agrupamentos, null, ['class' => 'form-control', 'placeholder' => 'Escolha um agrupamento']) }}
						</div><!-- /.form group --> 
						
						<!-- Responsável Unidade -->
						<div class="form-group">
							 {{ Form::label('UNI_RESPONSAVEL', 'Responsável') }}
		      				 {{ Form::text('UNI_RESPONSAVEL', '', ['class' => 'form-control', 'placeholder' => 'Ex.: Maurício Mattar']) }}
						</div><!-- /.form group -->
						<!-- CPF Responsável Unidade -->
						<div class="form-group">
							 {{ Form::label('UNI_TELRESPONSAVEL', 'Telefone do Responsável') }}
		      				 {{ Form::text('UNI_TELRESPONSAVEL', '', ['class' => 'form-control', 'placeholder' => 'Ex.: (61) 4444-7878']) }}
						</div><!-- /.form group -->
					</div>

				</div>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<a href="{{ url()->previous() }}" class="btn btn-default pull-left">Cancelar</a>
				{{ Form::submit('Adicionar Unidade', ['class' => 'btn btn-primary pull-right']) }}
			</div><!-- /.box-footer -->
			{!! Form::close() !!}
		</div><!-- /.box .box-primary -->
	</div><!-- /.col-md-9 -->
@stop