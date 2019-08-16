@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Imóveis <small>Editar Imóveis</small></h1>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="imovel">Imóveis</a></li>
    <li class="active">Atualizar</li>
</ol>
@stop

@section('content')

<div class="row">
    <div class="col-md-8">
        {!! Form::model($imovel, ['route' => ['imovel.update', $imovel->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

        <!-- Dados de Identificação -->
        <div class="box box-primary">
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
                            {{ Form::label('cliente_id', 'Cliente:', []) }}
                            {{ Form::select('cliente_id', $clientes, null, ['class' => 'avalidate form-control', 'disabled' => 'disabled', 'autocomplete' => 'off']) }}

                            @if ($errors->has('cliente_id'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('cliente_id') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('cnpj', 'CNPJ') }}
                            {{ Form::text('cnpj', $imovel->cnpj, ['class' => 'form-control mask-cnpj']) }}

                            @if ($errors->has('cnpj'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('cnpj') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('nome', 'Nome') }}
                            {{ Form::text('nome', $imovel->nome, ['class' => 'form-control nome']) }}

                            @if ($errors->has('nome'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('nome') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('logradouro', 'Logradouro') }}
                            {{ Form::text('logradouro', $imovel->endereco->logradouro, ['class' => 'form-control']) }}

                            @if ($errors->has('logradouro'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('logradouro') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('complemento', 'Complemento') }}
                            {{ Form::text('complemento', $imovel->endereco->complemento, ['class' => 'form-control']) }}

                            @if ($errors->has('complemento'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('complemento') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class='form-group'>
                            {{ Form::label('bairro', 'Bairro') }}
                            {{ Form::text('bairro', $imovel->endereco->bairro, ['class' => 'form-control bairro']) }}

                            @if ($errors->has('bairro'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('bairro') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('estado_id', 'Estado') }}
                            {{ Form::select('estado_id', $estados, $imovel->endereco->cidade->estado->id, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('estado_id'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('estado_id') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('cidade_id', 'Cidade') }}
                            {{ Form::select('cidade_id', $cidades, $imovel->endereco->cidade->id, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('cidade_id'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('cidade_id') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::label('numero', 'Número') }}
                                    {{ Form::text('numero', $imovel->endereco->numero ?? 'S/N', ['class' => 'form-control']) }}

                                    @if ($errors->has('numero'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('numero') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('cep', 'CEP') }}
                                    {{ Form::text('cep', $imovel->endereco->cep, ['class' => 'form-control mask-cep']) }}

                                    @if ($errors->has('cep'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('cep') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class='form-group'>
                            <div class='row'>
                                <div class='col-md-6'>
                                    {{ Form::label('fatura_ciclo', 'Dia Fechamento Fatura') }}

                                    @if(auth()->user()->id == 7)
                                    {{ Form::text('fatura_ciclo', $imovel->fatura_ciclo, ['class' => 'form-control']) }}
                                    @else
                                    {{ Form::text('fatura_ciclo', $imovel->fatura_ciclo, ['class' => 'form-control', 'disabled' => 'disabled']) }}
                                    @endif

                                    @if ($errors->has('fatura_ciclo'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('fatura_ciclo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class='col-md-6'>
                                    {{ Form::label('status', 'STATUS') }}
                                    {{ Form::select('status', ['' => 'Selecione', '1' => 'Ativo', '0' => 'Inativo'], $imovel->status, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                                    @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- [FIM] Dados de Identificação -->

        @is('Administrador')
        <!-- Configuração Central -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-cloud"></i> Configuração Central</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class='box-body'>
                <div class='row'>

                    <div class='col-md-6'>
                        <div class='form-group'>
                            {{ Form::label('ip', 'IP da Central') }}
                            {{ Form::text('ip', null, ['class' => 'form-control', 'placeholder' => 'Ex.: 000.000.000.000', 'data-error' => $errors->first('ip')]) }}

                            @if ($errors->has('ip'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('ip') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endis
        <!-- [FIM] Configuração Central -->

        <!-- Informações de contato -->
        <div class="box box-warning collapsed-box">
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
                            {{ Form::textarea('IMO_RESPONSAVEIS', null, ['class' => 'form-control', 'rows' => 4]) }}

                            @if ($errors->has('IMO_RESPONSAVEIS'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('IMO_RESPONSAVEIS') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class='form-group'>
                            {{ Form::label('IMO_TELEFONES', 'Telefones') }}
                            {{ Form::textarea('IMO_TELEFONES', null, ['class' => 'form-control', 'rows' => 4]) }}

                            @if ($errors->has('IMO_TELEFONES'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('IMO_TELEFONES') }}</strong>
                            </span>
                            @endif
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
                            {{ Form::label('taxa_fixa', 'Taxa Fixa (R$)') }}
                            {{ Form::text('taxa_fixa', $imovel->taxa_fixa, ['class' => 'form-control', 'placeholder' => 'Ex.: 3,99', 'data-error' => $errors->first('IMO_TAXAFIXA')]) }}

                            @if ($errors->has('taxa_fixa'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('taxa_fixa') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class='form-group'>
                            {{ Form::label('taxa_variavel', 'Taxa Variável (R$/m³/Kw)') }}
                            {{ Form::text('taxa_variavel', $imovel->taxa_variavel, ['class' => 'form-control', 'placeholder' => 'Ex.: 1,89', 'data-error' => $errors->first('taxa_variavel')]) }}

                            @if ($errors->has('taxa_variavel'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('taxa_variavel') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- [FIM] Taxas de cobrança -->

    </div>

    <div class="col-md-4">

        <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-teal imagem" id="preview-image-capa" @if($imovel->capa) style="background: url('{{ url("/upload/capas/".$imovel->capa) }}') center center;" @else style="background: url('http://www.condominiosc.com.br/media/k2/items/cache/2a7c5a55d24475c5674a6cabf9d5e3d4_XL.jpg') center center;" @endif >
                <h3 class="widget-user-username labelNome">Novo imóvel</h3>
                <h5 class="widget-user-desc labelBairro">[Bairro]</h5>
            </div>
            <div class="widget-user-image">
                <img class="img-circle" @if($imovel->foto) src="{{ url('/upload/fotos/'.$imovel->foto) }}" @else src="http://i63.tinypic.com/nex65y.png" @endif id="preview-image-foto" alt="User Avatar">
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

        <button type="submit" type="button" class="btn btn-block btn-warning"><i class="fa fa-floppy-o"></i> Atualizar cadastro</button>

        <div type="button" class="btn btn-block btn-primary div-foto"><i class="fa fa-file-image-o"></i> Fazer upload da foto de perfil
            <input onchange="previewUploadFoto(this, '#preview-image-foto')" class="btn-foto" type="file" name="foto">
        </div>

        <div type="button" class="btn btn-block btn-default div-foto"><i class="fa fa-file-image-o"></i> Fazer upload da foto de capa
            <input onchange="previewUploadCapa(this, '#preview-image-capa')" class="btn-foto" type="file" name="capa">
        </div>

        <button onclick="history.back()" type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>

    </div>

    {!! Form::close() !!}

    <!-- /.box .box-primary -->
</div>

@stop
