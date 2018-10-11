@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
    <h1>Imóveis <small>Adicionar Imóveis</small></h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Imóveis</a></li>
		<li class="active">Adicionar</li>
	</ol>
@stop

@section('content')
	<div class="row">
		<div class="col-md-8">
			{!! Form::open(['action' => 'ImovelController@store', 'method' => 'POST']) !!}

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
								{{ Form::label('IMO_CNPJ', 'CNPJ') }}
								{{ Form::text('IMO_CNPJ', '', ['class' => 'form-control', 'placeholder' => '']) }}
							</div>
							<div class='form-group'>
								{{ Form::label('IMO_NOME', 'Nome') }}
								{{ Form::text('IMO_NOME', '', ['class' => 'form-control', 'placeholder' => '']) }}
							</div>
							<div class='form-group'>
								{{ Form::label('IMO_LOGRADOURO', 'Logradouro') }}
								{{ Form::text('IMO_LOGRADOURO', '', ['class' => 'form-control', 'placeholder' => '']) }}
							</div>
							<div class='form-group'>
								{{ Form::label('IMO_COMPLEMENTO', 'Complemento') }}
								{{ Form::text('IMO_COMPLEMENTO', '', ['class' => 'form-control', 'placeholder' => '']) }}
							</div>
							<div class='form-group'>
								{{ Form::label('IMO_NUMERO', 'Número') }}
								{{ Form::text('IMO_NUMERO', '', ['class' => 'form-control', 'placeholder' => '']) }}
							</div>
						</div>

						<div class="col-md-6">
							<div class='form-group'>
								{{ Form::label('IMO_BAIRRO', 'Bairro') }}
								{{ Form::text('IMO_BAIRRO', '', ['class' => 'form-control', 'placeholder' => '']) }}
							</div>
							<div class='form-group'>
								{{ Form::label('IMO_CIDADE', 'Cidade') }}
								{{ Form::text('IMO_CIDADE', '', ['class' => 'form-control', 'placeholder' => '']) }}
							</div>
							<div class='form-group'>
								{{ Form::label('IMO_ESTADO', 'Estado') }}
								{{ Form::text('IMO_ESTADO', '', ['class' => 'form-control', 'placeholder' => '']) }}
							</div>
							<div class='form-group'>
								{{ Form::label('IMO_CEP', 'CEP') }}
								{{ Form::text('IMO_CEP', '', ['class' => 'form-control', 'placeholder' => '']) }}
							</div>
							<div class='form-group'>
								{{ Form::label('IMO_STATUS', 'STATUS') }}
								<select name='IMO_STATUS' class='form-control' >
									<option value='' selected>Selecione</option>
									<option value='1'>Ativo</option>
									<option value='0'>Inativo</option>
								</select>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- [FIM] Dados de Identificação -->

			<!-- Informações de contato -->

			<div class="box box-success collapsed-box">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-phone"></i> Informações de Contato</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
						</button>
					</div>
				</div>

				<div class='box-body'>
					<div class='row'>

						<div class='col-md-6'>
							<div class='form-group'>
								{{ Form::label('IMO_RESPONSAVEIS', 'Responsáveis') }}
								{{ Form::textarea('IMO_RESPONSAVEIS', '', ['class' => 'form-control', 'rows' => 4]) }}
							</div>
						</div>

						<div class="col-md-6">
							<div class='form-group'>
								{{ Form::label('IMO_TELEFONES', 'Telefones') }}
								{{ Form::textarea('IMO_TELEFONES', '', ['class' => 'form-control', 'rows' => 4]) }}
							</div>
						</div>

					</div>
				</div>
			</div>

			<!-- [FIM] Informações de contato -->

			<!-- Taxas de cobrança -->

			<div class="box box-danger collapsed-box">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-money"></i> Taxas de cobrança</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
						</button>
					</div>
				</div>

				<div class='box-body'>
					<div class='row'>

						<div class='col-md-6'>
							<div class='form-group'>
								{{ Form::label('IMO_TAXAFIXA', 'Taxa Fixa (R$)') }}
								{{ Form::text('IMO_TAXAFIXA', '', ['class' => 'form-control', 'placeholder' => 'Ex.: 3,99']) }}
							</div>
						</div>

						<div class="col-md-6">
							<div class='form-group'>
								{{ Form::label('IMO_TAXAVARIAVEL', 'Taxa Variável (R$/m³)') }}
								{{ Form::text('IMO_TAXAVARIAVEL', '', ['class' => 'form-control', 'placeholder' => 'Ex.: 1,89']) }}
							</div>
						</div>

					</div>
				</div>
			</div>

			<!-- [FIM] Taxas de cobrança -->

			{!! Form::close() !!}
		</div>

		<div class="col-md-4">

			<div class="box box-widget widget-user">
				<!-- Add the bg color to the header using any of the bg-* classes -->
				<div class="widget-user-header bg-teal" >
					<h3 class="widget-user-username">Novo imóvel</h3>
					<h5 class="widget-user-desc">[Bairro]</h5>
				</div>
				<div class="widget-user-image">
					<img class="img-circle" src="http://i63.tinypic.com/nex65y.png" alt="User Avatar">
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="col-sm-4 border-right">
							<div class="description-block">
								<h5 class="description-header">0</h5>
								<span class="description-text">AGRUPAMENTOS</span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 border-right">
							<div class="description-block">
								<h5 class="description-header">0</h5>
								<span class="description-text">UNIDADES</span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
							<div class="description-block">
								<h5 class="description-header">0</h5>
								<span class="description-text">EQUIPAMENTOS</span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
			</div>

			<button type="button" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Salvar cadastro</button>

			<button type="button" class="btn btn-block btn-primary"><i class="fa fa-file-image-o"></i> Fazer upload da foto de perfil</button>

			<button type="button" class="btn btn-block btn-default"><i class="fa fa-file-image-o"></i> Fazer upload da foto de capa</button>

			<button type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>

		</div>



	<!-- /.box .box-primary -->
	</div>
@stop