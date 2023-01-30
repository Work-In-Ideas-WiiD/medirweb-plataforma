@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Unidade <small>Atualizar usuario à unidade</small></h1>
<ol class="breadcrumb">
	<li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="/unidade/">Unidades</a></li>
	<li><a href="#">Atualizar #{{$unidade->id}}</a></li>
	<li><a href="#">Usuario Comum</a></li>
	<li class="active">Atualizar</li>
</ol>
@stop

@section('content')
{!! Form::model($user, ['route' => ['unidade.update_user', $user->unidade_id, $user->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

<div class="row">
	<div class="col-md-8">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-user"></i> Editar Usuário Comum para a Unidade</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class='box-body'>
				<div class='row'>

					<div class='col-md-6'>

						<div class='form-group'>
							{{ Form::label('nome_imovel', 'Imóvel') }}
							{{ Form::text('nome_imovel', $unidade->imovel->nome, ['class' => 'form-control', 'disabled']) }}
							{{ Form::hidden('imovel_id', $unidade->imovel_id) }}

							@error('imovel')
							<span class="help-block">
								<strong style="color: red;">{{ $message }}</strong>
							</span>
							@enderror
						</div>

						<div class='form-group'>
							{{ Form::label('nome_unidade', 'Unidade') }}
							{{ Form::text('nome_unidade', $unidade->nome, ['class' => 'form-control', 'disabled']) }}
							{{ Form::hidden('unidade_id', $unidade->id) }}

							@error('nome_unidade')
							<span class="help-block">
								<strong style="color: red;">{{ $message }}</strong>
							</span>
							@enderror
						</div>

						<div class='form-group'>
							{{ Form::label('email', 'E-mail') }}
							{{ Form::text('email', null, ['class' => 'form-control']) }}

							@error('email')
							<span class="help-block">
								<strong style="color: red;">{{ $message }}</strong>
							</span>
							@enderror
						</div>

					</div>

					<div class="col-md-6">

						<div class='form-group'>
							{{ Form::label('nome_agrupamento', 'Agrupamento') }}
							{{ Form::text('nome_agrupamento', $unidade->agrupamento->nome, ['class' => 'form-control', 'disabled']) }}

							@error('nome_agrupamento')
							<span class="help-block">
								<strong style="color: red;">{{ $message }}</strong>
							</span>
							@enderror
						</div>

						<div class='form-group'>
							{{ Form::label('name', 'Nome Completo') }}
							{{ Form::text('name', null, ['class' => 'form-control']) }}

							@error('name')
							<span class="help-block">
								<strong style="color: red;">{{ $message }}</strong>
							</span>
							@enderror
						</div>

						@is('Administrador')
						<div class='form-group'>
							{!! Form::label('roles', 'Perfil Extra', ['class' => 'control-label']) !!}
							{!! Form::select('roles[]', $roles, null, ['class' => 'form-control', 'multiple' => true]) !!}

							@error('roles')
							<span class="help-block">
								<strong style="color: red;">{{ $message }}</strong>
							</span>
							@enderror
						</div>
						@endis

					</div>

				</div>
			</div>
		</div>

		<!-- [FIM] Dados de Identificação -->

	</div>

	<div class="col-md-4">

		<button type="submit" type="button" class="btn btn-block btn-warning"><i class="fa fa-pencil"></i> Atualizar Usuário</button>

		<button onclick="history.back()" type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>

	</div>

	{!! Form::close() !!}

</div>
@stop
