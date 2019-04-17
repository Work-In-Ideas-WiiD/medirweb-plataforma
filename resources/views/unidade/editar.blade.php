@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Unidades <small>Atualizar Unidade</small></h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="#">Unidades</a></li>
	<li class="active">Atulizar</li>
</ol>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		{!! Form::model($unidade, ['route' => ['unidade.update', $unidade->UNI_ID], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

		<!-- Dados de Identificação -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa fa-th-large"></i> Dados da Unidade</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>

			<div class='box-body'>

				<div class="col-md-8">
					<div class='row'>

						<div class='col-md-6'>
							<div class='form-group'>
								{{ Form::label('UNI_IDIMOVEL', 'Imóvel') }}
								{{ Form::select('UNI_IDIMOVEL', $imoveis, null, ['class' => 'avalidate form-control', 'disabled' => 'disabled', 'autocomplete' => 'off']) }}

								@if ($errors->has('UNI_IDIMOVEL'))
								<span class="help-block">
									<strong style="color: red;">{{ $errors->first('UNI_IDIMOVEL') }}</strong>
								</span>
								@endif
							</div>
							<div class='form-group'>
								{{ Form::label('UNI_NOME', 'Nome da Unidade') }}
								{{ Form::text('UNI_NOME', null, ['class' => 'form-control', 'placeholder' => '']) }}

								@if ($errors->has('UNI_NOME'))
								<span class="help-block">
									<strong style="color: red;">{{ $errors->first('UNI_NOME') }}</strong>
								</span>
								@endif
							</div>
							<div class='form-group'>
								{{ Form::label('UNI_CPFRESPONSAVEL', 'CPF do Responsável') }}
								{{ Form::text('UNI_CPFRESPONSAVEL', null, ['class' => 'form-control mask-cpf', 'placeholder' => '']) }}

								@if ($errors->has('UNI_CPFRESPONSAVEL'))
								<span class="help-block">
									<strong style="color: red;">{{ $errors->first('UNI_CPFRESPONSAVEL') }}</strong>
								</span>
								@endif
							</div>
							<div class='form-group'>
								{{ Form::label('email', 'E-mail do Responsável') }}
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
								{{ Form::label('UNI_IDAGRUPAMENTO', 'Agrupamento') }}
								{{ Form::select('UNI_IDAGRUPAMENTO', $agrupamentos, null, ['class' => 'avalidate form-control', 'disabled' => 'disabled', 'autocomplete' => 'off']) }}

								@if ($errors->has('UNI_IDAGRUPAMENTO'))
								<span class="help-block">
									<strong style="color: red;">{{ $errors->first('UNI_IDAGRUPAMENTO') }}</strong>
								</span>
								@endif

							</div>
							<div class='form-group'>
								{{ Form::label('UNI_RESPONSAVEL', 'Responsável') }}
								{{ Form::text('UNI_RESPONSAVEL', null , ['class' => 'form-control', 'placeholder' => '']) }}

								@if ($errors->has('UNI_RESPONSAVEL'))
								<span class="help-block">
									<strong style="color: red;">{{ $errors->first('UNI_RESPONSAVEL') }}</strong>
								</span>
								@endif
							</div>
							<div class='form-group'>
								{{ Form::label('UNI_TELRESPONSAVEL', 'Telefone do Responsável') }}
								{{ Form::text('UNI_TELRESPONSAVEL', null, ['class' => 'form-control mask-phone', 'placeholder' => '']) }}

								@if ($errors->has('UNI_TELRESPONSAVEL'))
								<span class="help-block">
									<strong style="color: red;">{{ $errors->first('UNI_TELRESPONSAVEL') }}</strong>
								</span>
								@endif
							</div>

							@if(!empty($unidade['rolesUNI']))
							@is('Administrador')
							<?php // Perfil extra?>
							<div class='form-group'>
									{!! Form::label('rolesUNI', 'Perfil extra', ['class' => 'control-label']) !!}
									{!! Form::select('rolesUNI[]', $rolesUNI, null, ['class' => 'form-control']) !!}

									@if ($errors->has('roles'))
									<span class="help-block">
											<strong style="color: red;">{{ $errors->first('roles') }}</strong>
									</span>
									@endif
							</div>
							@endis
							@endif

						</div>

					</div>

					@if(!empty($unidade['email']))
					<div class="alert alert-warning" role="alert">
						<p>OBS.: Se alterar email, o responsável da unidade só conseguirar acessar o aplicativo com novo email inserido! Por favor, avise o mesmo!</p>
					</div>
					@endif

				</div>

				<div class="col-md-4">
					<button type="submit" type="button" class="btn btn-block btn-warning"><i class="fa fa-pencil"></i> Atualizar cadastro</button>
					<button onclick="history.back()" type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>
				</div>

			</div>
		</div>


		{!! Form::close() !!}
		<!-- [FIM] Dados de Identificação -->

		<!-- Equipamentos -->
		<div class="box box-danger collapsed-box">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-cog"></i> Equipamentos</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
					</button>
				</div>
			</div>
			<div class='box-body'>
				<div class='row'>
					<div class='col-md-12'>
						<table id="lista-clientes" class="table table-bordered table-hover powertabela">
							<thead>
								<tr>
									<th>#</th>
									<th>Nome</th>
									<th>ID Funcional</th>
									<th>Nº de Serial</th>
									<th>Operadora</th>
									<th>Fabricante</th>
									<th>Modelo</th>
									<th>Status</th>
									<th>Ações</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($prumadas as $pru)
								<tr>
									<td>{{ $pru->PRU_ID }}</td>
									<td>
										@if($pru->PRU_TIPO == 1)
										<div class="col-md-1"><i class="text-primary fa fa-tint"></i></div>
										@elseif($pru->PRU_TIPO == 2)
										<div class="col-md-1"><i style="color: #f38212;" class="fa fa-fire"></i></div>
										@elseif($pru->PRU_TIPO == 3)
										<div class="col-md-1"><i class="text-danger fa fa-bolt"></i></div>
										@endif
										<div class="col-md-9">{{ $pru->PRU_NOME }}</div>
									</td>
									<td>{{ $pru->PRU_IDFUNCIONAL }}</td>
									<td>{{ $pru->PRU_SERIAL }}</td>
									<td>{{ $pru->PRU_OPERADORA }}</td>
									<td>{{ $pru->PRU_FABRICANTE }}</td>
									<td>{{ $pru->PRU_MODELO }}</td>
									<td>
										@if($pru->PRU_STATUS == 1)
										Ativo
										@elseif($pru->PRU_STATUS == 0)
										Inativo
										@endif
									</td>
									<td>

										<?php // Botão editar ?>
										<div class="btn-group">
											<a href="{{ route('prumada.edit', ['pru' => $pru->PRU_ID]) }}" type="button" class="btn btn-warning btn-flat"><i class="fa fa-pencil"></i></a>
										</div>

										@is('Administrador')
										<?php // Botão deletar ?>
										<div class="btn-group">
											<?php $deleteFormPRU = "delete-formPRU-{$loop->index}"; ?>
											<a class="btn btn-danger btn-flat" data-toggle="modal" data-target="#delete_pru_ID{{$pru->PRU_ID}}"><i class="fa fa-trash-o"></i></a>

											<?php // modal deletar ?>
											<div class="modal fade" id="delete_pru_ID{{$pru->PRU_ID }}" tabindex="-1" role="dialog" aria-labelledby="delete_pru_ID{{$pru->PRU_ID}}Label" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title text-primary" id="delete_pru_ID{{$pru->PRU_ID}}Label"><i class="fa fa-trash-o"></i> Deletar Equipamento</h4>
														</div>
														<div class="modal-body">

															<p class="alert alert-danger">Tem certeza que deseja excluir equipamento #{{ $pru->PRU_ID }} ?</p>
															<div class="form-actions">
																<a href="{{ route('prumada.destroy', ['prumadas' => $pru->PRU_ID]) }}" onclick="event.preventDefault(); document.getElementById('{{$deleteFormPRU}}').submit();" class="btn btn-danger btn-flat">SIM</a>
																<button type="button" class="btn btn-default" data-dismiss="modal">NÃO</button>
															</div>

														</div>
													</div>
												</div>
											</div>

											{!! Form::open(['route' => ['prumada.destroy', 'pru' => $pru->PRU_ID], 'method' => 'DELETE', 'id' => $deleteFormPRU, 'style' => 'display:none']) !!}
											{!! Form::close() !!}

										</div>
										@endis

									</td>
								</form>
							</tr>
							@endforeach
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
	<!-- [FIM] Equipamentos -->

</div>



</div>
@stop
