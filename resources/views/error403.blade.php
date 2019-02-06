@extends('adminlte::page')

@section('title', 'MedirWeb')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="text-center text-danger">
            <h1><i class="fa fa-times"></i> VOCÊ NÃO TEM PERMISSÃO PARA ACESSAR ESSA PÁGINA!</h1>

            <button onclick="history.back()" type="button" class="btn btn-danger"><i class="fa fa-reply"></i> Voltar</button>

        </div>
    </div>
</div>

@stop
