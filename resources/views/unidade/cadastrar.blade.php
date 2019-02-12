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
{!! Form::open(['action' => 'UnidadeController@store', 'method' => 'POST']) !!}
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
							{{ Form::label('UNI_IDIMOVEL', 'Imóvel') }}
							{{ Form::select('UNI_IDIMOVEL', $imoveis, null, ['class' => 'avalidate form-control chosen-select-UNI_IDIMOVEL', 'autocomplete' => 'off']) }}

							@if ($errors->has('UNI_IDIMOVEL'))
							<span class="help-block">
								<strong style="color: red;">{{ $errors->first('UNI_IDIMOVEL') }}</strong>
							</span>
							@endif
						</div>
						<div class='form-group'>
							{{ Form::label('UNI_NOME', 'Nome') }}
							{{ Form::text('UNI_NOME', '', ['class' => 'form-control', 'placeholder' => '']) }}

							@if ($errors->has('UNI_NOME'))
							<span class="help-block">
								<strong style="color: red;">{{ $errors->first('UNI_NOME') }}</strong>
							</span>
							@endif
						</div>
						<div class='form-group'>
							{{ Form::label('UNI_CPFRESPONSAVEL', 'CPF do Responsável') }}
							{{ Form::text('UNI_CPFRESPONSAVEL', '', ['class' => 'form-control mask-cpf', 'placeholder' => '']) }}

							@if ($errors->has('UNI_CPFRESPONSAVEL'))
							<span class="help-block">
								<strong style="color: red;">{{ $errors->first('UNI_CPFRESPONSAVEL') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="col-md-6">
						<div class='form-group'>
							{{ Form::label('UNI_IDAGRUPAMENTO', 'Agrupamento') }}
							{{ Form::select('UNI_IDAGRUPAMENTO', ['' => 'Selecionar Agrupamento'], null, ['class' => 'avalidate form-control chosen-select-UNI_IDAGRUPAMENTO', 'autocomplete' => 'off']) }}

							@if ($errors->has('UNI_IDAGRUPAMENTO'))
							<span class="help-block">
								<strong style="color: red;">{{ $errors->first('UNI_IDAGRUPAMENTO') }}</strong>
							</span>
							@endif

						</div>
						<div class='form-group'>
							{{ Form::label('UNI_RESPONSAVEL', 'Responsável') }}
							{{ Form::text('UNI_RESPONSAVEL', '', ['class' => 'form-control', 'placeholder' => '']) }}

							@if ($errors->has('UNI_RESPONSAVEL'))
							<span class="help-block">
								<strong style="color: red;">{{ $errors->first('UNI_RESPONSAVEL') }}</strong>
							</span>
							@endif
						</div>
						<div class='form-group'>
							{{ Form::label('UNI_TELRESPONSAVEL', 'Telefone do Responsável') }}
							{{ Form::text('UNI_TELRESPONSAVEL', '', ['class' => 'form-control mask-phone', 'placeholder' => '']) }}

							@if ($errors->has('UNI_TELRESPONSAVEL'))
							<span class="help-block">
								<strong style="color: red;">{{ $errors->first('UNI_TELRESPONSAVEL') }}</strong>
							</span>
							@endif
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
