@extends('adminlte::page')

@section('title', 'MedirWeb')

@section('content_header')
    <h1>Clientes <small>Lista de Clientes</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Clientes</a></li>
        <li class="active">Listar</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Listagem</h3>
                </div>

                <div class='box-body'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <table id="lista-clientes" class="table table-bordered table-hover powertabela">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Data de Cadastro</th>
                                        <th>Documento</th>
                                        <th>Nome</th>
                                        <th>Origem</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $cliente)
                                        <tr>
                                            <td>{{ $cliente->CLI_ID  }}</td>
                                            <td>{{ date('d/m/Y H:i', strtotime($cliente->created_at)) }}</td>
                                            <td>{{ $cliente->CLI_DOCUMENTO }}</td>
                                            <td>{{ $cliente->CLI_NOMEJUR }}</td>
                                            <td>{{ $cliente->CLI_CIDADE }} - {{ $cliente->CLI_ESTADO }}</td>
                                            @if ($cliente->CLI_STATUS)
                                                <td>Ativo</td>
                                            @else
                                                <td>Inativo</td>
                                            @endif
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

