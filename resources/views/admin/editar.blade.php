@extends('adminlte::page')

@section('title', 'MedirWeb')

{!! Html::style( asset('css/total.css')) !!}

@section('content_header')
<h1>Usuários <small>Atualizar Usuário</small></h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Usuários</a></li>
    <li class="active">Atulizar</li>
</ol>
@stop

@section('content')

<div class="row">
    <div class="col-md-8">
        {{ Form::model($user, ['route' => ['usuario.update', $user->id], 'method' => 'PUT', 'files' => true, 'id' => 'formUsuario']) }}

        <!-- Dados de Identificação -->
        <div class="box box-warning">
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

                        <?php // Nome ?>
                        <div class='form-group'>
                            {{ Form::label('name', 'Nome:', ['data-error' => $errors->first('name')]) }}
                            {{ Form::text('name', null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>

                        <?php // Email ?>
                        <div class='form-group'>
                            {{ Form::label('email', 'Email:', ['data-error' => $errors->first('email')]) }}
                            {{ Form::email('email', null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <?php // Perfil ?>
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

                        <?php // Senha ?>
                        <div class='form-group'>
                            {{ Form::label('password', 'Senha:', ['data-error' => $errors->first('password')]) }}
                            {{ Form::password('password', ['class' => 'avalidate form-control']) }}

                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>

                        <?php // Confirma Senha ?>
                        <div class='form-group'>
                            {{ Form::label('password-confirm', 'Confirma Senha:', ['data-error' => $errors->first('password_confirmation')]) }}
                            {{ Form::password('password_confirmation', ['class' => 'avalidate form-control']) }}

                            @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>

                        <?php // Imovel ?>
                        <div class='form-group'>
                            {{ Form::label('USER_IMOID', 'Imóvel') }}
                            {{ Form::select('USER_IMOID', $imoveis, null, ['class' => 'avalidate form-control', 'autocomplete' => 'off']) }}

                            @if ($errors->has('USER_IMOID'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('USER_IMOID') }}</strong>
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

        <button type="submit" type="button" class="btn btn-block btn-warning"><i class="fa fa-pencil"></i> Atualizar cadastro</button>
        <button onclick="history.back()" type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i> Cancelar</button>

    </div>

    {!! Form::close() !!}

</div>

@stop
