@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
    <h1>Clientes <small>Adicionar Cliente</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Clientes</a></li>
        <li class="active">Adicionar</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            {!! Form::open(['action' => 'ClienteController@store', 'method' => 'POST']) !!}

            <! -- Informações Pessoais -->
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
                                <select name='CLI_TIPO' class='form-control' >
                                    <option value='' selected>Selecione uma opção</option>
                                    <option value='1'>CPF</option>
                                    <option value='2'>CNPJ</option>
                                </select>
                            </div>
                            <div class='form-group'>
                                {{ Form::label('CLI_DOCUMENTO', 'Documento') }}
                                {{ Form::text('CLI_DOCUMENTO', '', ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div class='form-group'>
                                {{ Form::label('CLI_NOMEJUR', 'Nome completo / Razão Social') }}
                                {{ Form::text('CLI_NOMEJUR', '', ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div class='form-group'>
                                {{ Form::label('CLI_NOMEFAN', 'Nome no comprovante / Nome Fantasia') }}
                                {{ Form::text('CLI_NOMEFAN', '', ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div class='form-group'>
                                {{ Form::label('CLI_DATANASC', 'Data de nascimento') }}
                                {{ Form::date('CLI_DATANASC', '', ['class'=>'form-control']) }}
                            </div>
                            <div class='form-group'>
                                {{ Form::label('CLI_STATUS', 'Status') }}
                                <select name='CLI_STATUS' class='form-control' >
                                    <option value='1'>Ativo</option>
                                    <option value='0'>Inativo</option>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div class='form-group'>
                                {{ Form::label('CLI_LOGRADOURO', 'Logradouro') }}
                                {{ Form::text('CLI_LOGRADOURO', '', ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div class='form-group'>
                                {{ Form::label('CLI_COMPLEMENTO', 'Complemento') }}
                                {{ Form::text('CLI_COMPLEMENTO', '', ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div class='form-group'>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ Form::label('CLI_NUMERO', 'Número') }}
                                        {{ Form::text('CLI_NUMERO', '', ['class' => 'form-control', 'placeholder' => '']) }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::label('CLI_CEP', 'CEP') }}
                                        {{ Form::text('CLI_CEP', '', ['class' => 'form-control', 'placeholder' => '']) }}
                                    </div>
                                </div>

                            </div>
                            <div class='form-group'>
                                {{ Form::label('CLI_BAIRRO', 'Bairro') }}
                                {{ Form::text('CLI_BAIRRO', '', ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div class='form-group'>
                                {{ Form::label('CLI_CIDADE', 'Cidade') }}
                                {{ Form::text('CLI_CIDADE', '', ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div class='form-group'>
                                {{ Form::label('CLI_ESTADO', 'Estado') }}
                                {{ Form::text('CLI_ESTADO', '', ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                        </div>

                    </div>
                </div>

                <!--<div class='box-footer'>
                    <a href='{{ url()->previous() }}'' class='btn btn-default pull-left'>Cancelar</a>
                    {{ Form::submit('Adicionar Cliente', ['class' => 'btn btn-primary pull-right']) }}
                </div>-->

            </div><!-- /.box .box-primary -->

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
                            </div>
                            <div class='form-group'>
                                {{ Form::label('CLI_DADOSCONTATO', 'Dados de contato') }}
                                {{ Form::textarea('CLI_DADOSCONTATO', '', ['class' => 'form-control', 'rows' => 4]) }}
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

            {!! Form::close() !!}
        </div><!-- /.col-md-9 -->

        <div class="col-md-4">

            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active" >
                    <h3 class="widget-user-username">Novo cliente</h3>
                    <h5 class="widget-user-desc"></h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="http://i64.tinypic.com/6gxxyo.png" alt="Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">0</h5>
                                <span class="description-text">Imóveis</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">0</h5>
                                <span class="description-text">Equipamentos ativos</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">0</h5>
                                <span class="description-text">Ocorrências em aberto</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>

            <button type="button" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Salvar cadastro</button>

            <button type="button" class="btn btn-block btn-primary"><i class="fa fa-file-image-o"></i> Fazer upload da foto</button>

            <button type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>

        </div>


    </div>
@stop