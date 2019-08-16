@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Clientes <small>Visualizar Cliente</small></h1>
<ol class="breadcrumb">
	<li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="/cliente">Cliente</a></li>
	<li class="active">Visualizar</li>
</ol>
@stop

@section('content')

<div class="row">
	<div class="col-md-12">

		<!-- Dados de Identificação -->
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-user"></i> Dados de Identificação</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class='box-body'>
				<div class='row'>

					<div class="col-md-1">
						<p class="titulo"></p>
						<img style="width: 100px; height: 100px; border: 3px solid #fff;" class="img-circle" @if(isset($cliente->CLI_FOTO)) src="{{ url('/upload/clientes/'.$cliente->CLI_FOTO) }}" @else src="http://i64.tinypic.com/6gxxyo.png" @endif  id="preview-image-foto" alt="Avatar">
					</div>

					<div class="col-md-10">

						<!-- Dados do Usuário -->
						<div class="col-md-3">
							<div class="bloco-imovel-info">
								<p class="titulo"><b><i class="fa fa-user"></i> Dados do Usuário</b></p>
								<p>{{ $cliente->documento }}</p>
								<p>{{ $cliente->data_nascimento }}</p>
								<p>{{ $cliente->nome_juridico }}</p>
								<p>{{ $cliente->nome_fantasia }}</p>
								<p>{{ $cliente->status ? 'Ativo' : 'Inativo' }}</p>
							</div>
						</div>
						<!-- FIM - Dados do Usuário -->

						<!-- Endereço -->
						<div class="col-md-3">
							<div class="bloco-imovel-info">
								<p class="titulo"><i class="fa fa-map"></i> <b>Localização</b></p>
								<p>{{ $cliente->endereco->logradouro }}</p>
								<p>{{ $cliente->endereco->complemento }}, Nº{{ $cliente->endereco->numero }}</p>
								<p>{{ $cliente->endereco->bairro }}</p>
								<p>{{ $cliente->endereco->cidade->nome }} - {{ $cliente->endereco->cidade->estado->nome }}</p>
								<p>{{ $cliente->endereco->cep }}</p>
							</div>
						</div>
						<!-- FIM - Endereço -->

						<!-- Infomação de contato -->
						<div class="col-md-3">
							<div class="bloco-imovel-info">
								<p class="titulo"><b><i class="fa fa-phone"></i> Contato</b></p>
								<pre style="border: none; background-color: white; font-family: 'Source Sans Pro';">{!! $cliente->CLI_DADOSCONTATO !!}</pre>
							</div>
						</div>
						<!-- FIM - Informação de contato -->

						<!-- Dados Bancarios -->
						<div class="col-md-3">
							<div class="bloco-imovel-info">
								<p class="titulo"><b><i class="fa fa-dollar"></i> Dados Bancarios</b></p>
								<pre style="border: none; background-color: white; font-family: 'Source Sans Pro';">{!! $cliente->CLI_DADOSBANCARIOS !!}</pre>
							</div>
						</div>
						<!-- FIM -  Dados Bancarios -->

					</div>

					<div class="col-md-1">
						<div class="row">
							<a href="/cliente" style="align:right;"class="btn btn-danger"><i class="fa fa-reply"></i> Voltar</a>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- [FIM] Dados de Identificação -->

	</div>
</div>

@stop
