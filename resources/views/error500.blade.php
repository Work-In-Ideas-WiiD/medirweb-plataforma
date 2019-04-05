@extends('adminlte::page')

@section('title', 'Error 500')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="text-center text-danger">
            <i class="fa fa-4x fa-times"></i>
            <h1>Opa, parece que algo deu errado. Erro interno do sistema!</h1>
            <h3>Por favor informe o erro para os administradores do sistema.</h3>
            <button onclick="history.back()" type="button" class="btn btn-danger"><i class="fa fa-reply"></i> Voltar</button>
        </div>
    </div>
</div>

@stop
