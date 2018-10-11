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
								<select name='AGR_IDIMOVEL' class='form-control' >
									<option value='' selected>Selecione um imóvel</option>
								</select>
							</div>
							<div class='form-group'>
								{{ Form::label('AGR_NOME', 'Nome') }}
								{{ Form::text('AGR_NOME', '', ['class' => 'form-control', 'placeholder' => '']) }}
							</div>
						</div>

						<div class="col-md-6">
							<div class='form-group'>
								{{ Form::label('AGR_TAXAFIXA', 'Taxa fixa (R$)') }}
								{{ Form::text('AGR_TAXAFIXA', '', ['class' => 'form-control', 'placeholder' => '']) }}
							</div>
							<div class='form-group'>
								{{ Form::label('AGR_TAXAVARIAVEL', 'Taxa variável (R$/m³)') }}
								{{ Form::text('AGR_TAXAVARIAVEL', '', ['class' => 'form-control', 'placeholder' => '']) }}
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- [FIM] Dados de Identificação -->

			{!! Form::close() !!}

		</div><!-- /.col-md-8 -->

		<div class="col-md-4">

			<button type="button" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Salvar cadastro</button>

			<button type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>

		</div>

	</div>
@stop