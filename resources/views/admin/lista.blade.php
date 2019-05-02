@extends('adminlte::page')

@section('title', 'MedirWeb')

@section('content_header')
<h1>{{$role->name}}<small>Lista de Usuários</small></h1>

<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
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
                @if($role->name == "Administrador")
                <a style="float: right" href="{{ route('usuario.create') }}" class="btn btn-success">Adicionar</a>
                @else
                <a style="float: right" href="{{ url('/user/'.$role->name.'/create') }}" class="btn btn-primary">Adicionar</a>
                @endif
            </div>

            <div class='box-body'>
                <div class='row'>
                    <div class='col-md-12'>
                        <table id="lista-clientes" class="table table-responsive table-bordered table-hover powertabela">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>e-mail</th>
                                    <th>Imóvel Vinculado</th>
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
                                        @if($usuario->USER_IMOID == 0)
                                        Nenhum Imóvel Vinculado!
                                        @else
                                        {{ $usuario->Imovel->IMO_NOME }}
                                        @endif
                                    </td>
                                    <td>
                                        <?php // Botão editar ?>
                                        <div class="btn-group">
                                            @if($role->name == "Administrador")
                                            <a href="{{ route('usuario.edit', ['usuario' => $usuario->id]) }}" type="button" class="btn btn-warning btn-flat"><i class="fa fa-pencil"></i></a>
                                            @else
                                            <a href="{{ route('user.edit', ['usuario' => $usuario->id]) }}" type="button" class="btn btn-warning btn-flat"><i class="fa fa-pencil"></i></a>
                                            @endif
                                        </div>

                                        <?php // Botão deletar ?>
                                        <div class="btn-group">
                                            <?php $deleteForm = "delete-form-{$loop->index}"; ?>
                                            <a class="btn btn-danger btn-flat" data-toggle="modal" data-target="#delete_user_ID{{$usuario->id}}"><i class="fa fa-trash-o"></i></a>

                                            <?php // modal deletar ?>
                                            <div class="modal fade" id="delete_user_ID{{$usuario->id }}" tabindex="-1" role="dialog" aria-labelledby="delete_user_ID{{$usuario->id}}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title text-primary" id="delete_user_ID{{$usuario->id}}Label"><i class="fa fa-trash-o"></i> Deletar Cliente</h4>
                                                        </div>
                                                        <div class="modal-body">

                                                            <p class="alert alert-danger">Tem certeza que deseja excluir usuário "{{ $usuario->name }}" ?</p>
                                                            <div class="form-actions">
                                                                <a href="{{ route('usuario.destroy', ['usuario' => $usuario->id]) }}" onclick="event.preventDefault(); document.getElementById('{{$deleteForm}}').submit();" class="btn btn-danger btn-flat">SIM</a>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">NÃO</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::open(['route' => ['usuario.destroy', 'usuario' => $usuario->id], 'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display:none']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
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
