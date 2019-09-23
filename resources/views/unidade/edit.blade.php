@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Unidade <small>Atualizar Unidade</small></h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="#">Unidades</a></li>
	<li class="active">Atualizar</li>
</ol>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		{!! Form::model($unidade, ['route' => ['unidade.update', $unidade->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) !!}

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
								{{ Form::label('imovel_id', 'Imóvel') }}
								{{ Form::select('imovel_id', $imoveis, null, ['class' => 'avalidate form-control', 'disabled']) }}

								@error('imovel_id')
								<span class="help-block">
									<strong style="color: red;">{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class='form-group'>
								{{ Form::label('nome', 'Nome da Unidade') }}
								{{ Form::text('nome', null, ['class' => 'form-control']) }}

								@error('nome')
								<span class="help-block">
									<strong style="color: red;">{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class='form-group'>
								{{ Form::label('cpf_responsavel', 'CPF do Responsável') }}
								{{ Form::text('cpf_responsavel', null, ['class' => 'form-control mask-cpf']) }}

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
								{{ Form::select('agrupamento_id', $agrupamentos, null, ['class' => 'avalidate form-control', 'disabled']) }}

								@error('agrupamento_id')
								<span class="help-block">
									<strong style="color: red;">{{ $message }}</strong>
								</span>
								@enderror

							</div>
							<div class='form-group'>
								{{ Form::label('nome_responsavel', 'Responsável') }}
								{{ Form::text('nome_responsavel', null , ['class' => 'form-control']) }}

								@error('nome_responsavel')
								<span class="help-block">
									<strong style="color: red;">{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class='form-group'>
								{{ Form::label('telefone', 'Telefone do Responsável') }}
								{{ Form::text('telefone', $unidade->telefone[0]->numero ?? null, ['class' => 'form-control mask-phone']) }}

								@error('telefone')
								<span class="help-block">
									<strong style="color: red;">{{ $message }}</strong>
								</span>
								@enderror
							</div>

						</div>

					</div>
					<div>
						@if ($errors->any())
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						@endif
					</div>
					@if(!empty($unidade['email']))
					<div class="alert alert-warning" role="alert">
						<p>OBS.: Se alterar email, o responsável da unidade só conseguirar acessar o aplicativo com novo email inserido! Por favor, avise o mesmo!</p>
					</div>
					@endif

				</div>

				<div class="col-md-4">
					<a href="{{ route('usuario.unidade', $unidade->id) }}" class="btn btn-block btn-primary"><i class="fa fa-user"></i> Criar Usuários à Unidade</a>
					<a href="{{ route('unidade.add_user_existente', $unidade->id) }}" class="btn btn-block btn-default"><i class="fa fa-user"></i> Adicionar Usuário Existente à Unidade</a>
					<button type="submit" type="button" class="btn btn-block btn-warning"><i class="fa fa-pencil"></i> Atualizar cadastro</button>
					<button onclick="history.back()" type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>
				</div>

			</div>
		</div>
		{!! Form::close() !!}
		<!-- [FIM] Dados de Identificação -->

		<!-- Usuarios Vinculos à Unidade-->
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-user"></i> Usuários Vinculos à Unidade</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class='box-body'>
				<div class='row'>
					<div class='col-md-12'>
						<table id="lista-clientes" class="table table-responsive table-bordered table-hover powertabela">
							<thead>
								<tr>
									<th>#</th>
									<th>Nome</th>
									<th>E-mail</th>
									<th>Ações</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($users as $user)
									@foreach ($user->roles as $roleUser)
										@if($roleUser->id == "4" )

										<tr>
											<td>{{ $user->id }}</td>
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td>

												<div class="btn-group">
													<a href="{{ route('unidade.edit_user', ['id' => $user->unidade_id, 'user_id' => $user->id]) }}" type="button" class="btn btn-warning btn-flat"><i class="fa fa-pencil"></i></a>
												</div>

												@is('Administrador')
												<div class="btn-group">
													<?php $deleteFormUSER = "delete-formUSER-{$loop->index}"; ?>
													<a class="btn btn-danger btn-flat" data-toggle="modal" data-target="#delete_user_ID{{$user->id}}"><i class="fa fa-trash-o"></i></a>

													<div class="modal fade" id="delete_user_ID{{$user->id }}" tabindex="-1" role="dialog" aria-labelledby="delete_user_ID{{$user->id}}Label" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																	<h4 class="modal-title text-primary" id="delete_user_ID{{$user->id}}Label"><i class="fa fa-trash-o"></i> Deletar Usuário</h4>
																</div>
																<div class="modal-body">

																	<p class="alert alert-danger">Tem certeza que deseja excluir usuário "{{ $user->name }}" ?</p>
																	<div class="form-actions">
																		<a href="{{ route('usuario.destroy', $user->id) }}" onclick="event.preventDefault(); document.getElementById('{{$deleteFormUSER}}').submit();" class="btn btn-danger btn-flat">SIM</a>
																		<button type="button" class="btn btn-default" data-dismiss="modal">NÃO</button>
																	</div>

																</div>
															</div>
														</div>
													</div>
													
													{!! Form::open(['route' => ['usuario.destroy', $user->id], 'method' => 'DELETE', 'id' => $deleteFormUSER, 'style' => 'display:none']) !!}
													{!! Form::close() !!}

												</div>
												@endis

												@is('Administrador')

												<div class="btn-group">
													<?php $desvincularFormUSER = "desvincular-formUSER-{$loop->index}"; ?>
													<a class="btn btn-primary btn-flat" data-toggle="modal" data-target="#desvincular_user_ID{{$user->id}}"><i class="fa fa-chain-broken"></i></a>


													<div class="modal fade" id="desvincular_user_ID{{$user->id }}" tabindex="-1" role="dialog" aria-labelledby="desvincular_user_ID{{$user->id}}Label" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																	<h4 class="modal-title text-primary" id="desvincular_user_ID{{$user->id}}Label"><i class="fa fa-chain-broken"></i> Desvincular Usuário</h4>
																</div>
																<div class="modal-body">

																	<p class="alert alert-danger">Tem certeza que deseja desvincular usuário "{{ $user->name }}" dessa unidade ?</p>
																	<div class="form-actions">
																		<a href="{{ route('unidade.desvincular_user', ['id' => $user->unidade_id, 'id_user' => $user->id]) }}" onclick="event.preventDefault(); document.getElementById('{{$desvincularFormUSER}}').submit();" class="btn btn-danger btn-flat">SIM</a>
																		<button type="button" class="btn btn-default" data-dismiss="modal">NÃO</button>
																	</div>

																</div>
															</div>
														</div>
													</div>

													{!! Form::open(['route' => ['unidade.desvincular_user', 'id' => $user->unidade_id, 'id_user' => $user->id], 'method' => 'DELETE', 'id' => $desvincularFormUSER, 'style' => 'display:none']) !!}
													{!! Form::close() !!}

												</div>
												@endis

											</td>
										</tr>

										@endif
									@endforeach
								@endforeach
							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
		<!-- [FIM] Usuarios Vinculos à Unidade-->

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
						<table id="lista-clientes" class="table table-responsive table-bordered table-hover powertabela">
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
									<td>{{ $pru->id }}</td>
									<td>
										@if($pru->tipo == 1)
										<div class="col-md-1"><i class="text-primary fa fa-tint"></i></div>
										@elseif($pru->tipo == 2)
										<div class="col-md-1"><i style="color: #f38212;" class="fa fa-fire"></i></div>
										@elseif($pru->tipo == 3)
										<div class="col-md-1"><i class="text-danger fa fa-bolt"></i></div>
										@endif
										<div class="col-md-9">{{ $pru->nome }}</div>
									</td>
									<td>{{ $pru->funcional_id }}</td>
									<td>{{ $pru->serial }}</td>
									<td>{{ $pru->operadora }}</td>
									<td>{{ $pru->fabricante }}</td>
									<td>{{ $pru->modelo }}</td>
									<td>
										@if($pru->status == 1)
										Ativo
										@elseif($pru->status == 0)
										Inativo
										@endif
									</td>
									<td>
										<div class="btn-group">
											<a href="{{ route('prumada.edit', $pru->id) }}" type="button" class="btn btn-warning btn-flat"><i class="fa fa-pencil"></i></a>
										</div>

										@is('Administrador')
										<?php // Botão deletar ?>
										<div class="btn-group">
											<?php $deleteFormPRU = "delete-formPRU-{$loop->index}"; ?>
											<a class="btn btn-danger btn-flat" data-toggle="modal" data-target="#delete_pru_ID{{$pru->id}}"><i class="fa fa-trash-o"></i></a>

											<?php // modal deletar ?>
											<div class="modal fade" id="delete_pru_ID{{$pru->id }}" tabindex="-1" role="dialog" aria-labelledby="delete_pru_ID{{$pru->id}}Label" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title text-primary" id="delete_pru_ID{{$pru->id}}Label"><i class="fa fa-trash-o"></i> Deletar Equipamento</h4>
														</div>
														<div class="modal-body">

															<p class="alert alert-danger">Tem certeza que deseja excluir equipamento #{{ $pru->id }} ?</p>
															<div class="form-actions">
																<a href="{{ route('prumada.destroy', $pru->id) }}" onclick="event.preventDefault(); document.getElementById('{{$deleteFormPRU}}').submit();" class="btn btn-danger btn-flat">SIM</a>
																<button type="button" class="btn btn-default" data-dismiss="modal">NÃO</button>
															</div>

														</div>
													</div>
												</div>
											</div>

											{!! Form::open(['route' => ['prumada.destroy', 'pru' => $pru->id], 'method' => 'DELETE', 'id' => $deleteFormPRU, 'style' => 'display:none']) !!}
											{!! Form::close() !!}

										</div>
										@endis

									</td>
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
