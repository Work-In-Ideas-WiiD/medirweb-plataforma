@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
    <h1>Imóveis <small>Adicionar Usuário</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Usuários</a></li>
        <li class="active">Adicionar</li>
    </ol>
@stop

@section('content')

    <div class="row">
        <div class="col-md-8">
        {!! Form::open(['route' => 'usuario.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

        <!-- Dados de Identificação -->

            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-home"></i> Dados do usuário</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class='box-body'>
                    <div class='row'>

                        <div class='col-md-6'>
                            <div class='form-group'>
                                {{ Form::label('name', 'Nome:', ['data-error' => $errors->first('name')]) }}
                                {{ Form::text('name', null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}


                                @if ($errors->has('name'))
                                    <span class="help-block">
										<strong style="color: red;">{{ $errors->first('name') }}</strong>
									</span>
                                @endif
                            </div>
                            <div class='form-group'>
                                {{ Form::label('email', 'Email:', ['data-error' => $errors->first('email')]) }}
                                {{ Form::email('email', null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                                @if ($errors->has('email'))
                                    <span class="help-block">
										<strong style="color: red;">{{ $errors->first('email') }}</strong>
									</span>
                                @endif
                            </div>

                            <div class='form-group'>
                                {!! Form::label('roles', 'Perfil *', ['class' => 'control-label']) !!}
                                {!! Form::select('roles[]', $roles, null, ['class' => 'form-control', 'multiple' => true]) !!}

                                @if ($errors->has('roles'))
                                    <span class="help-block">
                                                        <strong style="color: red;">{{ $errors->first('roles') }}</strong>
                                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class='form-group'>
                                {{ Form::label('password', 'Senha:', ['data-error' => $errors->first('password')]) }}
                                {{ Form::password('password', ['class' => 'avalidate form-control']) }}

                                @if ($errors->has('password'))
                                    <span class="help-block">
										<strong style="color: red;">{{ $errors->first('password') }}</strong>
									</span>
                                @endif
                            </div>
                            <div class='form-group'>
                                {{ Form::label('password-confirm', 'Confirma Senha:', ['data-error' => $errors->first('password_confirmation')]) }}
                                {{ Form::password('password_confirmation', ['class' => 'avalidate form-control']) }}

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
										<strong style="color: red;">{{ $errors->first('password_confirmation') }}</strong>
									</span>
                                @endif
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- [FIM] Dados de Identificação -->




        </div>

        <div class="col-md-4">

            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-teal imagem" id="preview-image-capa" style="background: url('http://www.condominiosc.com.br/media/k2/items/cache/2a7c5a55d24475c5674a6cabf9d5e3d4_XL.jpg') center center;">
                    <h3 class="widget-user-username labelNome">Novo Usuário</h3>
                    {{--<h5 class="widget-user-desc labelBairro">[Bairro]</h5>--}}
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="https://i.imgur.com/6H82qqD.png" id="preview-image-foto" alt="User Avatar">
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

            <button type="submit" type="button" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Salvar cadastro</button>

            <button onclick="history.back()" type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>

        </div>

    {!! Form::close() !!}

    <!-- /.box .box-primary -->
    </div>

@stop