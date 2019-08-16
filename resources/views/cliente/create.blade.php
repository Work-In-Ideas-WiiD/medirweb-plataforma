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
        {!! Form::open(['action' => 'ClienteController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

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
                                <option value='' selected>Selecione uma opção</option>
                                <option value='1'>CPF</option>
                                <option value='2'>CNPJ</option>
                            </select>

                            @if ($errors->has('tipo'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('tipo') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group cpf'>
                            {{ Form::label('cpf', 'Documento') }}
                            {{ Form::text('cpf', '', ['class' => 'form-control mask-cpf classcpf']) }}

                            @if ($errors->has('cpf'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('cpf') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group cnpj' style="display: none;">
                            {{ Form::label('cnpj', 'Documento') }}
                            {{ Form::text('cnpj', '', ['class' => 'form-control mask-cnpj classcnpj']) }}

                            @if ($errors->has('cnpj'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('cnpj') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('nome_juridico', 'Nome completo / Razão Social') }}
                            {{ Form::text('nome_juridico', '', ['class' => 'form-control']) }}

                            @if ($errors->has('nome_juridico'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('nome_juridico') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('nome_fantasia', 'Nome no comprovante / Nome Fantasia') }}
                            {{ Form::text('nome_fantasia', '', ['class' => 'form-control nome']) }}

                            @if ($errors->has('nome_fantasia'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('nome_fantasia') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('data_nascimento', 'Data de nascimento') }}
                            {{ Form::date('data_nascimento', '', ['class'=>'form-control']) }}

                            @if ($errors->has('data_nascimento'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('data_nascimento') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('status', 'Status') }}
                            <select name='CLI_STATUS' class='form-control' >
                                <option value='1'>Ativo</option>
                                <option value='0'>Inativo</option>
                            </select>

                            @if ($errors->has('status'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('status') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class='col-md-6'>
                        <div class='form-group'>
                            {{ Form::label('logradouro', 'Logradouro') }}
                            {{ Form::text('logradouro', '', ['class' => 'form-control']) }}

                            @if ($errors->has('logradouro'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('logradouro') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('complemento', 'Complemento') }}
                            {{ Form::text('complemento', '', ['class' => 'form-control']) }}

                            @if ($errors->has('complemento'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('complemento') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::label('numero', 'Número') }}
                                    {{ Form::text('numero', '', ['class' => 'form-control']) }}

                                    @if ($errors->has('numero'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('numero') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('cep', 'CEP') }}
                                    {{ Form::text('cep', '', ['class' => 'form-control']) }}

                                    @if ($errors->has('cep'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('cep') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class='form-group'>
                            {{ Form::label('bairro', 'Bairro') }}
                            {{ Form::text('bairro', '', ['class' => 'form-control']) }}

                            @if ($errors->has('bairro'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('bairro') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('estado_id', 'Estado') }}
                            {{ Form::select('estado_id', $estados, null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('estado_id'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('estado_id') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('cidade_id', 'Cidade') }}
                            {{ Form::select('cidade_id', ['' => 'Selecionar Cidade'], null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('cidade_id'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('cidade_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- [FIM] Informações Pessoais -->

        <!-- Informações Bancárias -->
        <div class="box box-success collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-credit-card"></i> Informações de cobrança</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class='box-body'>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class='form-group'>
                            {{ Form::label('CLI_DADOSBANCARIOS', 'Dados Bancários') }}
                            {{ Form::textarea('CLI_DADOSBANCARIOS', '', ['class' => 'form-control', 'rows' => 4]) }}

                            @if ($errors->has('CLI_DADOSBANCARIOS'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('CLI_DADOSBANCARIOS') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('CLI_DADOSCONTATO', 'Dados de contato') }}
                            {{ Form::textarea('CLI_DADOSCONTATO', '', ['class' => 'form-control', 'rows' => 4]) }}

                            @if ($errors->has('CLI_DADOSCONTATO'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('CLI_DADOSCONTATO') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [FIM] Informações Bancárias -->

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
                <img class="img-circle" src="http://i64.tinypic.com/6gxxyo.png" id="preview-image-foto" alt="Avatar">
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
