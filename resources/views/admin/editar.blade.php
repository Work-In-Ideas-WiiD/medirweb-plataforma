@extends('layouts.admin.layout')
@section('title', 'Editar Administrador')

@section('content')
    <script>
        $(function() {
            @if ($errors->has('name'))	$('input[name="name"]').addClass('invalid'); @endif
			@if ($errors->has('email'))	$('input[name="email"]').addClass('invalid'); @endif
			@if ($errors->has('password')) $('input[name="password"]').addClass('invalid'); @endif
			@if ($errors->has('password_confirmation')) $('input[name="password_confirmation"]').addClass('invalid'); @endif
			$('input.invalid').attr('placeholder', '');
        });
    </script>
    <div class="row">
        <div class="col s12 m12 l8 offset-l2">
            @component('components.panel' , ['button' => '<a href="#" onclick="history.back()" class="waves-effect waves-light btn btn-acao right"><i class="ico-arrow-left4 left"></i>Voltar</a>'])
            @slot('titulo', 'Editar Administrador')
            {{ Form::model($user, ['route' => ['usuario.update', $user->id], 'method' => 'PUT', 'files' => true, 'id' => 'formUsuario']) }}

            <div class="row">
                <div class="col s12 m12">
                    <div class="row">

                        <div class="input-field col s12">
                            {{ Form::text('name', null, ['class' => 'avalidate', 'autocomplete' => 'off']) }}
                            {{ Form::label('name', 'Nome:', ['data-error' => $errors->first('name')]) }}
                        </div>
                        <div class="input-field col s12">
                            {{ Form::email('email', null, ['class' => 'avalidate', 'autocomplete' => 'off']) }}
                            {{ Form::label('email', 'Email:', ['data-error' => $errors->first('email')]) }}
                        </div>
                        <div class="input-field col s12 m6">
                            {{ Form::password('password', null, ['class' => 'avalidate']) }}
                            {{ Form::label('password', 'Senha:', ['data-error' => $errors->first('password')]) }}
                        </div>
                        <div class="input-field col s12 m6">
                            {{ Form::password('password_confirmation', null, ['class' => 'avalidate', 'id' => 'password-confirm']) }}
                            {{ Form::label('password-confirm', 'Confirma Senha:', ['data-error' => $errors->first('password_confirmation')]) }}
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="waves-effect waves-light btn btn-custom">
                                SALVAR <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
            @endcomponent
        </div>
    </div>
@endsection