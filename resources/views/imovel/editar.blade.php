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
        {!! Form::model($imovel, ['route' => ['imovel.update', $imovel->IMO_ID], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

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
                            {{ Form::label('IMO_IDCLIENTE', 'Cliente:', []) }}
                            {{ Form::select('IMO_IDCLIENTE', $clientes, null, ['class' => 'avalidate form-control', 'disabled' => 'disabled', 'autocomplete' => 'off']) }}

                            @if ($errors->has('IMO_IDCLIENTE'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('IMO_IDCLIENTE') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('IMO_CNPJ', 'CNPJ') }}
                            {{ Form::text('IMO_CNPJ', null, ['class' => 'form-control mask-cnpj']) }}

                            @if ($errors->has('IMO_CNPJ'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('IMO_CNPJ') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('IMO_NOME', 'Nome') }}
                            {{ Form::text('IMO_NOME', null, ['class' => 'form-control nome', 'placeholder' => '']) }}

                            @if ($errors->has('IMO_NOME'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('IMO_NOME') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('IMO_LOGRADOURO', 'Logradouro') }}
                            {{ Form::text('IMO_LOGRADOURO', null, ['class' => 'form-control', 'placeholder' => '']) }}

                            @if ($errors->has('IMO_LOGRADOURO'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('IMO_LOGRADOURO') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('IMO_COMPLEMENTO', 'Complemento') }}
                            {{ Form::text('IMO_COMPLEMENTO', null, ['class' => 'form-control', 'placeholder' => '']) }}

                            @if ($errors->has('IMO_COMPLEMENTO'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('IMO_COMPLEMENTO') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class='form-group'>
                            {{ Form::label('IMO_BAIRRO', 'Bairro') }}
                            {{ Form::text('IMO_BAIRRO', null, ['class' => 'form-control bairro', 'placeholder' => '']) }}

                            @if ($errors->has('IMO_BAIRRO'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('IMO_BAIRRO') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('IMO_IDESTADO', 'Estado') }}
                            {{--{{ Form::text('IMO_IDESTADO', '', ['class' => 'form-control', 'placeholder' => '']) }}--}}
                            {{ Form::select('IMO_IDESTADO', $estados, null, ['class' => 'avalidate form-control chosen-select-IMO_IDESTADO', 'autocomplete' => 'off']) }}

                            @if ($errors->has('IMO_IDESTADO'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('IMO_IDESTADO') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            {{ Form::label('IMO_IDCIDADE', 'Cidade') }}
                            {{--{{ Form::text('IMO_IDCIDADE', '', ['class' => 'form-control', 'placeholder' => '']) }}--}}
                            {{ Form::select('IMO_IDCIDADE', $cidades, null, ['class' => 'avalidate form-control chosen-select-IMO_IDCIDADE', 'autocomplete' => 'off']) }}

                            @if ($errors->has('IMO_IDCIDADE'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('IMO_IDCIDADE') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class='form-group'>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::label('IMO_NUMERO', 'Número') }}
                                    {{ Form::text('IMO_NUMERO', null, ['class' => 'form-control mask-num', 'placeholder' => '']) }}

                                    @if ($errors->has('IMO_NUMERO'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('IMO_NUMERO') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('IMO_CEP', 'CEP') }}
                                    {{ Form::text('IMO_CEP', null, ['class' => 'form-control mask-cep', 'placeholder' => '']) }}

                                    @if ($errors->has('IMO_CEP'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('IMO_CEP') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class='form-group'>
                            <div class='row'>
                                <div class='col-md-6'>
                                    {{ Form::label('IMO_FATURACICLO', 'Dia Fechamento Fatura') }}
                                    {{ Form::text('IMO_FATURACICLO', null, ['class' => 'form-control', 'placeholder' => '']) }}

                                    @if ($errors->has('IMO_FATURACICLO'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('IMO_FATURACICLO') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class='col-md-6'>
                                    {{ Form::label('IMO_STATUS', 'STATUS') }}
                                    {{ Form::select('IMO_STATUS', ['' => 'Selecione', '1' => 'Ativo', '0' => 'Inativo'], null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                                    @if ($errors->has('IMO_STATUS'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('IMO_STATUS') }}</strong>
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
                            {{ Form::label('IMO_IP', 'IP da Central') }}
                            {{ Form::text('IMO_IP', null, ['class' => 'form-control mask-ip', 'placeholder' => 'Ex.: 000.000.000.000', 'data-error' => $errors->first('IMO_IP')]) }}

                            @if ($errors->has('IMO_IP'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('IMO_IP') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @else
        {{ Form::text('IMO_IP', null, ['class' => 'form-control mask-ip', 'placeholder' => 'Ex.: 000.000.000.000', 'data-error' => $errors->first('IMO_IP'), 'style' => 'display:none']) }}
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
                            {{ Form::label('IMO_TAXAFIXA', 'Taxa Fixa (R$)') }}
                            {{ Form::text('IMO_TAXAFIXA', null, ['class' => 'form-control', 'placeholder' => 'Ex.: 3,99', 'data-error' => $errors->first('IMO_TAXAFIXA')]) }}

                            @if ($errors->has('IMO_TAXAFIXA'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('IMO_TAXAFIXA') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class='form-group'>
                            {{ Form::label('IMO_TAXAFIXA', 'Taxa Variável (R$/m³)') }}
                            {{ Form::text('IMO_TAXAVARIAVEL', null, ['class' => 'form-control', 'placeholder' => 'Ex.: 1,89', 'data-error' => $errors->first('IMO_TAXAVARIAVEL')]) }}

                            @if ($errors->has('IMO_TAXAFIXA'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('IMO_TAXAFIXA') }}</strong>
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
            <div class="widget-user-header bg-teal imagem" id="preview-image-capa" @if(isset($imovel->IMO_CAPA)) style="background: url('{{ url("/upload/capas/".$imovel->IMO_CAPA) }}') center center;" @else style="background: url('http://www.condominiosc.com.br/media/k2/items/cache/2a7c5a55d24475c5674a6cabf9d5e3d4_XL.jpg') center center;" @endif >
                <h3 class="widget-user-username labelNome">Novo imóvel</h3>
                <h5 class="widget-user-desc labelBairro">[Bairro]</h5>
            </div>
            <div class="widget-user-image">
                <img class="img-circle" @if(isset($imovel->IMO_FOTO)) src="{{ url('/upload/fotos/'.$imovel->IMO_FOTO) }}" @else src="http://i63.tinypic.com/nex65y.png" @endif id="preview-image-foto" alt="User Avatar">
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
