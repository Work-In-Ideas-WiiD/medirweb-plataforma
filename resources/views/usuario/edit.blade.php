@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Usuários <small>Atualizar Usuário</small></h1>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/usuario">Usuários</a></li>
    <li class="active">Atualizar</li>
</ol>
@stop

@section('content')
{{ Form::model($usuario, ['route' => ['usuario.update', $usuario->id], 'method' => 'PUT', 'files' => true, 'id' => 'formUsuario', 'autocomplete' => 'off']) }}
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user"></i> Dados do usuário</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class='box-body'>
                <div class='row'>

                    <div class='col-md-6'>

                        <div class='form-group'>
                            {{ Form::label('name', 'Nome:') }}
                            {{ Form::text('name', null, ['class' => 'avalidate form-control']) }}

                            @error('name')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class='form-group'>
                            {{ Form::label('email', 'Email:') }}
                            {{ Form::email('email', null, ['class' => 'avalidate form-control']) }}

                            @error('email')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class='form-group'>
                            {!! Form::label('roles', 'Perfil *') !!}
                            {!! Form::select('roles[]', $roles, null, ['class' => 'form-control', 'multiple' => true]) !!}

                            @error('roles')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class='form-group'>
                            {{ Form::label('password', 'Senha:') }}
                            {{ Form::password('password', ['class' => 'avalidate form-control']) }}

                            @error('password')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class='form-group'>
                            {{ Form::label('password-confirm', 'Confirma Senha:') }}
                            {{ Form::password('password_confirmation', ['class' => 'avalidate form-control']) }}

                            @error('password_confirmation')
                            <span class="help-block">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">

        <div class="box box-widget widget-user">
            <div class="widget-user-header bg-aqua-active" >
                <h3 class="widget-user-username labelNome">{{auth()->user()->name}}</h3>
                <h5 class="widget-user-desc"></h5>
            </div>
            <div class="widget-user-image">
                <img class="img-circle" @if(isset(auth()->user()->foto)) src="{{ url('/upload/usuarios/'.auth()->user()->foto) }}" @else src="/upload/usuarios/user_default.png" @endif  id="preview-image-foto_user" alt="Avatar">
            </div>
            <div class="box-footer">
                <small>Obs.: recomendado imagem no tamanho quadrado! Ex.: 100x100</small>
            </div>
        </div>

        <button type="submit" type="button" class="btn btn-block btn-warning"><i class="fa fa-pencil"></i> Atualizar cadastro</button>

        <div type="button" class="btn btn-block btn-primary div-foto"><i class="fa fa-file-image-o"></i> Fazer upload da foto
            <input onchange="previewUploadFoto(this, '#preview-image-foto_user')" class="btn-foto" type="file" name="fotoUser">
        </div>

        <button onclick="history.back()" type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>

    </div>

</div>
{!! Form::close() !!}
@stop
