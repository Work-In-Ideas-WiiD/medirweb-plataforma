@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Unidade <small>Adicionar usuario à unidade</small></h1>
<ol class="breadcrumb">
	<li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="/unidade/">Unidades</a></li>
    <li><a href="{{ route('usuario.unidade', $unidade->id) }}">Atualizar #{{ $unidade->id }}</a></li>
	<li><a href="#">Usuario Comum</a></li>
	<li class="active">Adicionar</li>
</ol>
@stop

@section('content')
{!! Form::open(['route' => ['usuario.unidade.store', $unidade->id], 'method' => 'POST']) !!}
<div class="row">
	<div class="col-md-8">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-user"></i> Novo Usuário Comum para a Unidade</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class='box-body'>
				<div class='row'>

					<div class='col-md-6'>

						<div class='form-group'>
							{{ Form::label('', 'Imóvel') }}
							{{ Form::text('', $unidade->imovel->nome, ['class' => 'form-control', 'disabled']) }}
							{{ Form::hidden('imovel_id', $unidade->imovel_id) }}

						</div>

						<div class='form-group'>
							{{ Form::label('NomeUnidade', 'Unidade') }}
							{{ Form::text('NomeUnidade', $unidade->nome, ['class' => 'form-control', 'disabled']) }}
							{{ Form::hidden('unidade_id', $unidade->id) }}

						</div>

						<div class='form-group'>
							{{ Form::label('email', 'E-mail do Novo Usuário') }}
							{{ Form::text('email', '', ['class' => 'form-control']) }}

							@error('email')
							<span class="help-block">
								<strong style="color: red;">{{ $message }}</strong>
							</span>
							@enderror
						</div>

					</div>

					<div class="col-md-6">

						<div class='form-group'>
							{{ Form::label('', 'Agrupamento') }}
							{{ Form::text('', $unidade->agrupamento->nome, ['class' => 'form-control', 'disabled']) }}

						</div>

						<div class='form-group'>
							{{ Form::label('name', 'Nome Completo do Novo Usuário') }}
							{{ Form::text('name', null, ['class' => 'form-control']) }}

							@error('name')
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

		<button type="submit" type="button" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Salvar Novo Usuário</button>

		<button onclick="history.back()" type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>

	</div>

	{!! Form::close() !!}

</div>
@stop
