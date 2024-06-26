@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Imóveis <small>Vizualizar Imóveis</small></h1>
<ol class="breadcrumb">
	<li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="/imovel">Imóveis</a></li>
	<li class="active">Vizualizar</li>
</ol>
@stop

@section('content')

<div class="row">
	<div class="col-md-12">

		<!-- Dados de Identificação -->
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-building"></i> {{ $imovel->nome }}</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>

			<div class='box-body'>
				<div class='row'>

					<!-- Infomação -->
					<div class="col-md-4">
						<div class="bloco-imovel-info">
							<p class="titulo"><i class="fa fa-map"></i> <b>Localização</b></p>
							<p>{{ $imovel->endereco->logradouro }}</p>
							<p>{{ $imovel->complemento }}</p>
							<p>{{ $imovel->endereco->cidade->nome }} - {{ $imovel->endereco->cidade->estado->nome }}</p>
							<p>{{ $imovel->endereco->cep }}</p>
						</div>
					</div>
					<!-- FIM Informação -->

					<!-- Infomação -->
					<div class="col-md-4">
						<div class="bloco-imovel-info">
							<p class="titulo"><b><i class="fa fa-user"></i> Responsáveis</b></p>
							<pre style="border: none; background-color: white; font-family: 'Source Sans Pro';">{!! $imovel->IMO_RESPONSAVEIS !!}</pre>
						</div>
					</div>
					<!-- FIM Informação -->

					<!-- Infomação -->
					<div class="col-md-4">
						<div class="bloco-imovel-info">
							<p class="titulo"><b><i class="fa fa-phone"></i> Contato</b></p>
							<pre style="border: none; background-color: white; font-family: 'Source Sans Pro';">{!! $imovel->IMO_TELEFONES !!}</pre>
						</div>
					</div>
					<!-- FIM Informação -->


				</div>
			</div>
		</div>
		<!-- [FIM] Dados de Identificação -->

		<!-- Agrupamento -->
		<div class="box box-warning collapsed-box">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-building"></i> Agrupamentos</h3>
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
									<th>Agrupamento</th>
									<th>Ações</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($imovel->agrupamento as $agrup)
								<tr>
									<td>{{ $agrup->id }}</td>
									<td>{{ $agrup->nome }}</td>
									<td>

										<?php // Botão editar ?>
										<div class="btn-group">
											<a href="{{ route('agrupamento.edit', ['agrup' => $agrup->id]) }}" type="button" class="btn btn-warning btn-flat"><i class="fa fa-pencil"></i></a>
										</div>

										@is('Administrador')
										<?php // Botão deletar ?>
										<div class="btn-group">
											<?php $deleteFormAGR = "delete-formAGR-{$loop->index}"; ?>
											<a class="btn btn-danger btn-flat" data-toggle="modal" data-target="#delete_agrup_ID{{$agrup->id}}"><i class="fa fa-trash-o"></i></a>

											<?php // modal deletar ?>
											<div class="modal fade" id="delete_agrup_ID{{$agrup->id }}" tabindex="-1" role="dialog" aria-labelledby="delete_agrup_ID{{$agrup->id}}Label" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title text-primary" id="delete_agrup_ID{{$agrup->id}}Label"><i class="fa fa-trash-o"></i> Deletar Cliente</h4>
														</div>
														<div class="modal-body">

															<p class="alert alert-danger">Tem certeza que deseja excluir agrupamento "{{ $agrup->nome }}" ?</p>
															<div class="form-actions">
																<a href="{{ route('agrupamento.destroy', ['agrupamento' => $agrup->id]) }}" onclick="event.preventDefault(); document.getElementById('{{$deleteFormAGR}}').submit();" class="btn btn-danger btn-flat">SIM</a>
																<button type="button" class="btn btn-default" data-dismiss="modal">NÃO</button>
															</div>

														</div>
													</div>
												</div>
											</div>

											{!! Form::open(['route' => ['agrupamento.destroy', 'agrupamento' => $agrup->id], 'method' => 'DELETE', 'id' => $deleteFormAGR, 'style' => 'display:none']) !!}
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
		<!-- [FIM] Agrupamento-->


		<!-- Unidades -->
		<div class="box box-danger collapsed-box">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-th-large"></i> Unidades</h3>
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
									<th>Unidade</th>
									<th>Responsável</th>
									<th>CPF</th>
									<th>Telefone</th>
									<th>Ações</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($imovel->unidade as $uni)

								<tr>
									<td>{{ $uni->id }}</td>
									<td>{{ $uni->nome }}</td>
									<td>{{ $uni->nome_responsavel }}</td>
									<td>{{ $uni->cpf_responsavel }}</td>
									<td>{{ $uni->telefone[0]->numero ?? 'não informado' }}</td>
									<td>

										<?php // Botão editar ?>
										<div class="btn-group">
											<a href="{{ route('unidade.edit', ['unidade' => $uni->id]) }}" type="button" class="btn btn-warning btn-flat"><i class="fa fa-pencil"></i></a>
										</div>

										@is('Administrador')
										<?php // Botão deletar ?>
										<div class="btn-group">
											<?php $deleteFormUNI = "delete-formUNI-{$loop->index}"; ?>
											<a class="btn btn-danger btn-flat" data-toggle="modal" data-target="#delete_uni_ID{{$uni->id}}"><i class="fa fa-trash-o"></i></a>

											<?php // modal deletar ?>
											<div class="modal fade" id="delete_uni_ID{{$uni->id }}" tabindex="-1" role="dialog" aria-labelledby="delete_uni_ID{{$uni->id}}Label" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title text-primary" id="delete_uni_ID{{$uni->id}}Label"><i class="fa fa-trash-o"></i> Deletar Cliente</h4>
														</div>
														<div class="modal-body">

															<p class="alert alert-danger">Tem certeza que deseja excluir unidade "{{ $uni->nome }}" ?</p>
															<div class="form-actions">
																<a href="{{ route('unidade.destroy', ['unidade' => $uni->id]) }}" onclick="event.preventDefault(); document.getElementById('{{$deleteFormUNI}}').submit();" class="btn btn-danger btn-flat">SIM</a>
																<button type="button" class="btn btn-default" data-dismiss="modal">NÃO</button>
															</div>

														</div>
													</div>
												</div>
											</div>

											{!! Form::open(['route' => ['unidade.destroy', 'unidade' => $uni->id], 'method' => 'DELETE', 'id' => $deleteFormUNI, 'style' => 'display:none']) !!}
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
		<!-- [FIM] Unidades -->

		<?php // GRAFICO ?>
		<div class="col-md-12">
			<div class="row">
				<div class="form-group">
					<div class="box box-primary collapse-box">
						<div class="box-header with-border gray" style="background-color: #3c8dbc; color: white; text-align: center;">
							<h3 class="box-title" style="font-weight: 600; font-size: 15px; text-align: center;"></i> GRAFICO</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
							</div>
						</div>
						<div class='box-body' style="text-align: center;">
							<div class="col-md-12">
								{!! $chartConsumoLine->container() !!}
								{!! $chartConsumoLine->script() !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php // FIM - GRAFICO ?>

	</div>

	{!! Form::close() !!}

</div>

@stop
