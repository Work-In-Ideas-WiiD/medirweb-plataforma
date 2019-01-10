@extends('adminlte::page')

@section('title', 'MedirWeb')

@section('content_header')
    <h1>Administradores <small>Lista de Usuários</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Usuários</a></li>
        <li class="active">Listar</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Listagem</h3>
                    <a style="float: right" href="{{ route('usuario.create') }}" class="btn btn-primary">Adicionar</a>
                </div>

                <div class='box-body'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <table id="lista-clientes" class="table table-bordered table-hover powertabela">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>e-mail</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario->id  }}</td>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('usuario.edit', ['usuario' => $usuario->id]) }}" type="button" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i></a>
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

