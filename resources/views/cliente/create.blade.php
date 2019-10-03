@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Clientes <small>Adicionar Cliente</small></h1>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/cliente">Clientes</a></li>
    <li class="active">Adicionar</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        {!! Form::open(['route' => 'cliente.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) !!}

        <!-- Informações Pessoais -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user"></i> Dados de Identificação</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class='box-body'>
                <div class='row'>

                    <div class='col-md-6'>
                        <div class='form-group'>
                            {{ Form::label('tipo', 'Tipo') }}
                            <select id='tipo' name='tipo' class='form-control' >
                                <option value='1'>CPF</option>
                                <option value='2'>CNPJ</option>
                            </select>

                            @error('tipo')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class='form-group cpf'>
                            {{ Form::label('documento', 'Documento') }}
                            {{ Form::text('documento', old('documento'), ['class' => 'form-control']) }}

                            @error('documento')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class='form-group'>
                            {{ Form::label('nome_juridico', 'Nome completo / Razão Social') }}
                            {{ Form::text('nome_juridico', old('nome_juridico'), ['class' => 'form-control']) }}

                            @error('nome_juridico')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class='form-group'>
                            {{ Form::label('nome_fantasia', 'Nome no comprovante / Nome Fantasia') }}
                            {{ Form::text('nome_fantasia', '', ['class' => 'form-control nome']) }}

                            @error('nome_fantasia')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class='form-group'>
                            {{ Form::label('data_nascimento', 'Data de nascimento') }}
                            {{ Form::date('data_nascimento', old('data_nascimento'), ['class'=>'form-control']) }}

                            @error('data_nascimento')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class='form-group'>
                            {{ Form::label('status', 'Status') }}
                            <select name='status' class='form-control' >
                                <option value='1'>Ativo</option>
                                <option value='0'>Inativo</option>
                            </select>

                            @error('status')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class='col-md-6'>
                        <div class='form-group'>
                            {{ Form::label('logradouro', 'Logradouro') }}
                            {{ Form::text('logradouro', old('logradouro'), ['class' => 'form-control']) }}

                            @error('logradouro')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class='form-group'>
                            {{ Form::label('complemento', 'Complemento') }}
                            {{ Form::text('complemento', old('complemento'), ['class' => 'form-control']) }}

                            @error('complemento')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class='form-group'>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::label('numero', 'Número') }}
                                    {{ Form::text('numero', old('numero'), ['class' => 'form-control']) }}

                                    @error('numero')
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('cep', 'CEP') }}
                                    {{ Form::text('cep', old('cep'), ['class' => 'form-control']) }}

                                    @error('cep')
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class='form-group'>
                            {{ Form::label('bairro', 'Bairro') }}
                            {{ Form::text('bairro', old('bairro'), ['class' => 'form-control']) }}

                            @error('bairro')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class='form-group'>
                            {{ Form::label('estado_id', 'Estado') }}
                            {{ Form::select('estado_id', $estados, old('estado_id'), ['class' => 'avalidate form-control']) }}

                            @error('estado_id')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class='form-group'>
                            {{ Form::label('cidade_id', 'Cidade') }}
                            {{ Form::select('cidade_id', $cidades, old('cidade_id'), ['class' => 'avalidate form-control', 'placeholder' => 'selecionar cidade']) }}

                            @error('cidade_id')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- [FIM] Informações Pessoais -->

        <!-- Informações Bancárias -->
        <div class="box box-danger collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-paperclip"></i> Anexos</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>

            <div class='box-body'>
                <div class='row'>
                    <div class='col-md-12'>
                        <p class="text-center">Não há anexos.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- [FIM] Informações Bancárias -->

    </div>

    <div class="col-md-4">

        <div class="box box-widget widget-user">
            <div class="widget-user-header bg-aqua-active" >
                <h3 class="widget-user-username labelNome">Novo cliente</h3>
                <h5 class="widget-user-desc"></h5>
            </div>
            <div class="widget-user-image">
                <img class="img-circle" src="https://via.placeholder.com/100" id="preview-image-foto" alt="Avatar">
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">0</h5>
                            <span class="description-text">Imóveis</span>
                        </div>
                    </div>
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">0</h5>
                            <span class="description-text">Equipamentos ativos</span>
                        </div>
                    </div>
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">0</h5>
                            <span class="description-text">Ocorrências em aberto</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" type="button" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Salvar cadastro</button>

        <div type="button" class="btn btn-block btn-primary div-foto"><i class="fa fa-file-image-o"></i> Fazer upload da foto
            <input onchange="previewUploadFoto(this, '#preview-image-foto')" class="btn-foto" type="file" name="foto">
        </div>

        <button onclick="history.back()" type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>

    </div>

    {!! Form::close() !!}

</div>
@stop
