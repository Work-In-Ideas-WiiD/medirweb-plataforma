@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Unidade <small>Atualizar usuario à unidade</small></h1>
<ol class="breadcrumb">
	<li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="/unidade/">Unidades</a></li>
	<li><a href="/unidade/editar/{{$unidade['UNI_ID']}}">Atualizar #{{$unidade["UNI_ID"]}}</a></li>
	<li><a href="#">Usuario Comum</a></li>
	<li class="active">Atualizar/li>
</ol>
@stop

@section('content')
{!! Form::model($user, ['route' => ['unidade.update_user', $user->USER_UNIID, $user->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

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
							{{ Form::label('NomeImovel', 'Imóvel') }}
							{{ Form::text('NomeImovel', $unidade->Imovel->IMO_NOME, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => '']) }}
							{{ Form::select('USER_IMOID', [$unidade->Imovel->IMO_ID => $unidade->Imovel->IMO_ID], $unidade->Imovel->IMO_ID, ['style' => 'display:none']) }}

							@if ($errors->has('NomeImovel'))
							<span class="help-block">
								<strong style="color: red;">{{ $errors->first('NomeImovel') }}</strong>
							</span>
							@endif
						</div>

						<div class='form-group'>
							{{ Form::label('NomeUnidade', 'Unidade') }}
							{{ Form::text('NomeUnidade', $unidade->UNI_NOME, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => '']) }}
							{{ Form::select('USER_UNIID', [$unidade->UNI_ID => $unidade->UNI_ID], $unidade->UNI_ID, ['style' => 'display:none']) }}

							@if ($errors->has('NomeUnidade'))
							<span class="help-block">
								<strong style="color: red;">{{ $errors->first('NomeUnidade') }}</strong>
							</span>
							@endif
						</div>

						<div class='form-group'>
							{{ Form::label('email', 'E-mail') }}
							{{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => '']) }}

							@if ($errors->has('email'))
							<span class="help-block">
								<strong style="color: red;">{{ $errors->first('email') }}</strong>
							</span>
							@endif
						</div>

					</div>

					<div class="col-md-6">

						<div class='form-group'>
							{{ Form::label('NomeAgrupamento', 'Agrupamento') }}
							{{ Form::text('NomeAgrupamento', $unidade->Agrupamento->AGR_NOME, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => '']) }}

							@if ($errors->has('NomeAgrupamento'))
							<span class="help-block">
								<strong style="color: red;">{{ $errors->first('NomeAgrupamento') }}</strong>
							</span>
							@endif
						</div>

						<div class='form-group'>
							{{ Form::label('name', 'Nome Completo') }}
							{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => '']) }}

							@if ($errors->has('name'))
							<span class="help-block">
								<strong style="color: red;">{{ $errors->first('name') }}</strong>
							</span>
							@endif
						</div>

						@is('Administrador')
						<?php // Perfil extra?>
						<div class='form-group'>
								{!! Form::label('rolesUNI', 'Perfil extra', ['class' => 'control-label']) !!}
								{!! Form::select('rolesUNI[]', $rolesUNI, $unidade['rolesUNI'], ['class' => 'form-control']) !!}

								@if ($errors->has('roles'))
								<span class="help-block">
										<strong style="color: red;">{{ $errors->first('roles') }}</strong>
								</span>
								@endif
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
