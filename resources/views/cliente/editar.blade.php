@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Clientes <small>Editar Cliente</small></h1>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/cliente">Clientes</a></li>
    <li class="active">Atualizar</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        {!! Form::model($cliente, ['route' => ['clinete.update', $cliente->CLI_ID], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

        <!-- Informações Pessoais -->
        <div class="box box-warning">
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
                            {{ Form::label('CLI_TIPO', 'Tipo') }}
                            {{ Form::select('CLI_TIPO', ['' => 'Selecione uma opção', '1' => 'CPF', '2' => 'CNPJ'], null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('CLI_TIPO'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('CLI_TIPO') }}</strong>
                            </span>
                            @endif
                        </div>
                        @if($cliente->CLI_TIPO == 1)
                        <div class='form-group cpf'>
                            {{ Form::label('cpf', 'Documento') }}
                            {{ Form::text('cpf', $cliente->CLI_DOCUMENTO, ['class' => 'form-control mask-cpf classcpf', 'placeholder' => '']) }}

                            @if ($errors->has('cpf'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('cpf') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class='form-group cnpj' style="display: none;">
                            {{ Form::label('cnpj', 'Documento') }}
                            {{ Form::text('cnpj', '', ['class' => 'form-control mask-cnpj classcnpj', 'placeholder' => '']) }}

                            @if ($errors->has('cnpj'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('cnpj') }}</strong>
                            </span>
                            @endif
                        </div>
                        @else
                        <div class='form-group cpf' style="display: none;">
                            {{ Form::label('cpf', 'Documento') }}
                            {{ Form::text('cpf', '', ['class' => 'form-control mask-cpf classcpf', 'placeholder' => '']) }}

                            @if ($errors->has('cpf'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('cpf') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class='form-group cnpj' >
                            {{ Form::label('cnpj', 'Documento') }}
                            {{ Form::text('cnpj', $cliente->CLI_DOCUMENTO, ['class' => 'form-control mask-cnpj classcnpj', 'placeholder' => '']) }}

                            @if ($errors->has('cnpj'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('cnpj') }}</strong>
                            </span>
                            @endif
                        </div>
                        @endif


                        <div class='form-group'>
                            {{ Form::label('CLI_NOMEJUR', 'Nome completo / Razão Social') }}
                            {{ Form::text('CLI_NOMEJUR', null, ['class' => 'form-control', 'placeholder' => '']) }}

                            @if ($errors->has('CLI_NOMEJUR'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('CLI_NOMEJUR') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('CLI_NOMEFAN', 'Nome no comprovante / Nome Fantasia') }}
                            {{ Form::text('CLI_NOMEFAN', null, ['class' => 'form-control nome', 'placeholder' => '']) }}

                            @if ($errors->has('CLI_NOMEFAN'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('CLI_NOMEFAN') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('CLI_DATANASC', 'Data de nascimento') }}
                            {{ Form::date('CLI_DATANASC', null, ['class'=>'form-control']) }}

                            @if ($errors->has('CLI_DATANASC'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('CLI_DATANASC') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('CLI_STATUS', 'Status') }}
                            <select name='CLI_STATUS' class='form-control' >
                                <option value='1'>Ativo</option>
                                <option value='0'>Inativo</option>
                            </select>

                            @if ($errors->has('CLI_STATUS'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('CLI_STATUS') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class='col-md-6'>
                        <div class='form-group'>
                            {{ Form::label('CLI_LOGRADOURO', 'Logradouro') }}
                            {{ Form::text('CLI_LOGRADOURO', null, ['class' => 'form-control', 'placeholder' => '']) }}

                            @if ($errors->has('CLI_LOGRADOURO'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('CLI_LOGRADOURO') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('CLI_COMPLEMENTO', 'Complemento') }}
                            {{ Form::text('CLI_COMPLEMENTO', null, ['class' => 'form-control', 'placeholder' => '']) }}

                            @if ($errors->has('CLI_COMPLEMENTO'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('CLI_COMPLEMENTO') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::label('CLI_NUMERO', 'Número') }}
                                    {{ Form::text('CLI_NUMERO', null, ['class' => 'form-control', 'placeholder' => '']) }}

                                    @if ($errors->has('CLI_NUMERO'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('CLI_NUMERO') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('CLI_CEP', 'CEP') }}
                                    {{ Form::text('CLI_CEP', null, ['class' => 'form-control', 'placeholder' => '']) }}

                                    @if ($errors->has('CLI_CEP'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('CLI_CEP') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class='form-group'>
                            {{ Form::label('CLI_BAIRRO', 'Bairro') }}
                            {{ Form::text('CLI_BAIRRO', null, ['class' => 'form-control', 'placeholder' => '']) }}

                            @if ($errors->has('CLI_BAIRRO'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('CLI_BAIRRO') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('CLI_ESTADO', 'Estado') }}
                            {{--{{ Form::text('CLI_ESTADO', '', ['class' => 'form-control', 'placeholder' => '']) }}--}}
                            {{ Form::select('CLI_ESTADO', $estados, null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('CLI_ESTADO'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('CLI_ESTADO') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('CLI_CIDADE', 'Cidade') }}
                            {{--{{ Form::text('CLI_CIDADE', '', ['class' => 'form-control', 'placeholder' => '']) }}--}}
                            {{ Form::select('CLI_CIDADE', $cidades, null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('CLI_CIDADE'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('CLI_CIDADE') }}</strong>
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
                            {{ Form::textarea('CLI_DADOSBANCARIOS', null, ['class' => 'form-control', 'rows' => 4]) }}

                            @if ($errors->has('CLI_DADOSBANCARIOS'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('CLI_DADOSBANCARIOS') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('CLI_DADOSCONTATO', 'Dados de contato') }}
                            {{ Form::textarea('CLI_DADOSCONTATO', null, ['class' => 'form-control', 'rows' => 4]) }}

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

        <!-- Anexos -->
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
        <!-- [FIM] Anexos -->


    </div><!-- /.col-md-9 -->

    <div class="col-md-4">

        <div class="box box-widget widget-user">

            <div class="widget-user-header bg-aqua-active" >
                <h3 class="widget-user-username labelNome">Novo cliente</h3>
                <h5 class="widget-user-desc"></h5>
            </div>
            <div class="widget-user-image">
                <img class="img-circle" @if(isset($cliente->CLI_FOTO)) src="{{ url('/upload/clientes/'.$cliente->CLI_FOTO) }}" @else src="http://i64.tinypic.com/6gxxyo.png" @endif  id="preview-image-foto" alt="Avatar">
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

        <button type="submit" type="button" class="btn btn-block btn-warning"><i class="fa fa-pencil"></i> Atualizar cadastro</button>

        <div type="button" class="btn btn-block btn-primary div-foto"><i class="fa fa-file-image-o"></i> Fazer upload da foto
            <input onchange="previewUploadFoto(this, '#preview-image-foto')" class="btn-foto" type="file" name="foto">
        </div>

        <button onclick="history.back()" type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>

    </div>

    {!! Form::close() !!}

</div>
@stop
