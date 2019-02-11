@extends('adminlte::page')

@section('title', 'MedirWeb')

@section('content_header')
<h1>Clientes <small>Lista de Clientes</small></h1>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
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
                <a style="float: right" href="{{ route('Adicionar Cliente') }}" class="btn btn-primary">Adicionar</a>
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
                                    <td>{{ $cliente->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $cliente->CLI_DOCUMENTO }}</td>
                                    <td>{{ $cliente->CLI_NOMEJUR }}</td>
                                    <td>{{ $cliente->CLI_CIDADE }} - {{ $cliente->CLI_ESTADO }}</td>
                                    @if ($cliente->CLI_STATUS)
                                    <td>Ativo</td>
                                    @else
                                    <td>Inativo</td>
                                    @endif
                                    <td>

                                        <?php // Botão visualizar ?>
                                        <div class="btn-group">
                                            <a href="{{ route('Ver Cliente', ['cliente' => $cliente->CLI_ID]) }}" type="button" class="btn btn-info btn-flat"><i class="fa fa-eye"></i></a>
                                        </div>

                                        <?php // BOTÃO EDITAR ?>
                                        <div class="btn-group">
                                            <a href="{{ route('clinete.edit', ['cliente' => $cliente->CLI_ID]) }}" type="button" class="btn btn-warning btn-flat"><i class="fa fa-pencil"></i></a>
                                        </div>

                                        <?php // Botão deletar ?>
                                        <div class="btn-group">
                                            <?php $deleteForm = "delete-form-{$loop->index}"; ?>
                                            <a class="btn btn-danger btn-flat" data-toggle="modal" data-target="#delete_cliente_ID{{$cliente->CLI_ID}}"><i class="fa fa-trash-o"></i></a>

                                            <?php // modal deletar ?>
                                            <div class="modal fade" id="delete_cliente_ID{{ $cliente->CLI_ID }}" tabindex="-1" role="dialog" aria-labelledby="delete_cliente_ID{{$cliente->CLI_ID}}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title text-primary" id="delete_cliente_ID{{$cliente->CLI_ID}}Label"><i class="fa fa-trash-o"></i> Deletar Cliente</h4>
                                                        </div>
                                                        <div class="modal-body">

                                                            <p class="alert alert-danger">Tem certeza que deseja excluir cliente "{{ $cliente->CLI_NOMEJUR }}" ?</p>
                                                            <div class="form-actions">
                                                                <a href="{{ route('cliente.destroy', ['cliente' => $cliente->CLI_NOMEJUR]) }}" onclick="event.preventDefault(); document.getElementById('{{$deleteForm}}').submit();" class="btn btn-danger btn-flat">SIM</a>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">NÃO</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::open(['route' => ['cliente.destroy', 'cliente' => $cliente->CLI_ID], 'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display:none']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                        <?php // FIM - Botão deletar ?>

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
