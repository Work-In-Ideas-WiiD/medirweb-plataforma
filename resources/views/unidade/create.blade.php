@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Unidades <small>Adicionar unidade</small></h1>
<ol class="breadcrumb">
	<li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="#">Unidades</a></li>
	<li class="active">Adicionar</li>
</ol>
@stop

@section('content')
{!! Form::open(['route' => 'unidade.store', 'method' => 'POST', 'autocomplete' => 'off']) !!}
<div class="row">
	<div class="col-md-8">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-home"></i> Dados da Nova Unidade</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class='box-body'>
				<div class='row'>

					<div class='col-md-6'>
						<div class='form-group'>
							{{ Form::label('imovel_id', 'Imóvel') }}
							{{ Form::select('imovel_id', $imoveis, null, ['class' => 'avalidate form-control']) }}

							@error('imovel_id')
							<span class="help-block">
								<strong style="color: red;">{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class='form-group'>
							{{ Form::label('nome', 'Nome da Unidade') }}
							{{ Form::text('nome', '', ['class' => 'form-control']) }}

							@error('nome')
							<span class="help-block">
								<strong style="color: red;">{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class='form-group'>
							{{ Form::label('cpf_responsavel', 'CPF do Responsável') }}
							{{ Form::text('cpf_responsavel', '', ['class' => 'form-control mask-cpf']) }}

							@error('cpf_responsavel')
							<span class="help-block">
								<strong style="color: red;">{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<div class="col-md-6">
						<div class='form-group'>
							{{ Form::label('agrupamento_id', 'Agrupamento') }}
							{{ Form::select('agrupamento_id', $agrupamentos, null, ['class' => 'avalidate form-control', 'placeholder' => 'Selecione um agrupamento']) }}

							@error('agrupamento_id')
							<span class="help-block">
								<strong style="color: red;">{{ $message }}</strong>
							</span>
							@enderror

						</div>
						<div class='form-group'>
							{{ Form::label('nome_responsavel', 'Responsável') }}
							{{ Form::text('nome_responsavel', '', ['class' => 'form-control']) }}

							@error('UNI_RESPONSAVEL')
							<span class="help-block">
								<strong style="color: red;">{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class='form-group'>
							{{ Form::label('telefone', 'Telefone do Responsável') }}
							{{ Form::text('telefone', '', ['class' => 'form-control mask-phone']) }}

							@error('telefone')
							<span class="help-block">
								<strong style="color: red;">{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

				</div>
			</div>
		</div>

		<!-- [FIM] Dados de Identificação -->

	</div>

	<div class="col-md-4">

		<button type="submit" type="button" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Salvar cadastro</button>

		<button onclick="history.back()" type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>

	</div>

	{!! Form::close() !!}

</div>
@stop
