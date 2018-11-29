@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
    <h1>Agrupamentos <small>Adicionar Agrupamento</small></h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Agrupamentos</a></li>
		<li class="active">Adicionar</li>
	</ol>
@stop

@section('content')
	<div class="row">
		<div class="col-md-8">
			{!! Form::open(['action' => 'AgrupamentoController@store', 'method' => 'POST']) !!}

			<!-- Dados de Identificação -->

			<div class="box box-warning">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-home"></i> Dados de identificação</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
				</div>

				<div class='box-body'>
					<div class='row'>

						<div class='col-md-6'>
							<div class='form-group'>
								{{ Form::label('AGR_IDIMOVEL', 'Imóvel') }}
								{{ Form::select('AGR_IDIMOVEL', $imoveis, null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

								@if ($errors->has('AGR_IDIMOVEL'))
									<span class="help-block">
										    <strong style="color: red;">{{ $errors->first('AGR_IDIMOVEL') }}</strong>
									    </span>
								@endif
							</div>
							<div class='form-group'>
								{{ Form::label('AGR_NOME', 'Nome') }}
								{{ Form::text('AGR_NOME', '', ['class' => 'form-control', 'placeholder' => '']) }}

								@if ($errors->has('AGR_NOME'))
									<span class="help-block">
										    <strong style="color: red;">{{ $errors->first('AGR_NOME') }}</strong>
									    </span>
								@endif
							</div>
						</div>

						<div class="col-md-6">
							<div class='form-group'>
								{{ Form::label('AGR_TAXAFIXA', 'Taxa fixa (R$)') }}
								{{ Form::text('AGR_TAXAFIXA', '', ['class' => 'form-control', 'placeholder' => '']) }}

								@if ($errors->has('AGR_TAXAFIXA'))
									<span class="help-block">
										    <strong style="color: red;">{{ $errors->first('AGR_TAXAFIXA') }}</strong>
									    </span>
								@endif
							</div>
							<div class='form-group'>
								{{ Form::label('AGR_TAXAVARIAVEL', 'Taxa variável (R$/m³)') }}
								{{ Form::text('AGR_TAXAVARIAVEL', '', ['class' => 'form-control', 'placeholder' => '']) }}

								@if ($errors->has('AGR_TAXAVARIAVEL'))
									<span class="help-block">
										    <strong style="color: red;">{{ $errors->first('AGR_TAXAVARIAVEL') }}</strong>
									    </span>
								@endif
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- [FIM] Dados de Identificação -->

		</div><!-- /.col-md-8 -->

		<div class="col-md-4">

			<button type="submit" type="button" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Salvar cadastro</button>

			<button onclick="history.back()" type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>

		</div>

		{!! Form::close() !!}

	</div>
@stop