@extends('adminlte::page')

@section('title', config('app.name'))

@section('content_header')
<h1>Imóveis <small>Lista de Imóveis</small></h1>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Imóveis</a></li>
    <li class="active">Listar</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Listagem</h3>
                <a style="float: right" href="{{ route('imovel.create') }}" class="btn btn-primary">Adicionar</a>
            </div>
            <div class='box-body'>
                <div class='row'>
                    <div class='col-md-12'>
                        <table id="lista-clientes" class="table table-responsive table-bordered table-hover powertabela">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Imóvel</th>
                                    <th>Cliente</th>
                                    <th>Cidade</th>
                                    <th>Estado</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($imoveis as $imovel)
                                <tr>
                                    <td>{{ $imovel->id  }}</td>
                                    <td>{{ $imovel->nome }}</td>
                                    <td>{{ $imovel->cliente->nome_juridico }}</td>
                                    <td>{{ $imovel->endereco->cidade->nome }}</td>
                                    <td>{{ $imovel->endereco->cidade->estado->codigo }}</td>
                                    
                                    <td>{{ $imovel->status ? 'Ativo' : 'Inativo'}}</td>
                                    
                                    <td>

                                        <?php // Botão visualizar ?>
                                        <div class="btn-group">
                                            <a href="{{ route('imovel.show', $imovel->id) }}" type="button" class="btn btn-info btn-flat"><i class="fa fa-eye"></i></a>
                                        </div>

                                        @is(['Administrador', 'Sindico'])
                                        <?php // Botão editar ?>
                                        <div class="btn-group">
                                            <a href="{{ route('imovel.edit', $imovel->id) }}" type="button" class="btn btn-warning btn-flat"><i class="fa fa-pencil"></i></a>
                                        </div>
                                        @endis

                                        @is('Administrador')
                                        <?php // Botão deletar ?>
                                        <div class="btn-group">
                                            <?php $deleteForm = "delete-form-{$loop->index}"; ?>
                                            <a class="btn btn-danger btn-flat" data-toggle="modal" data-target="#delete_imo_ID{{$imovel->id}}"><i class="fa fa-trash-o"></i></a>

                                            <?php // modal deletar ?>
                                            <div class="modal fade" id="delete_imo_ID{{$imovel->id }}" tabindex="-1" role="dialog" aria-labelledby="delete_imo_ID{{$imovel->id}}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title text-primary" id="delete_imo_ID{{$imovel->id}}Label"><i class="fa fa-trash-o"></i> Deletar Cliente</h4>
                                                        </div>
                                                        <div class="modal-body">

                                                            <p class="alert alert-danger">Tem certeza que deseja excluir imóvel "{{ $imovel->nome }}" ?</p>
                                                            <div class="form-actions">
                                                                <a href="{{ route('imovel.destroy', $imovel->id) }}" onclick="event.preventDefault(); document.getElementById('{{$deleteForm}}').submit();" class="btn btn-danger btn-flat">SIM</a>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">NÃO</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {!! Form::open(['route' => ['imovel.destroy', $imovel->id], 'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display:none']) !!}
                                            {!! Form::close() !!}

                                        </div>
                                        @endis

                                        @is(['Administrador', 'Sindico'])
                                        <?php // Botão lançar consumo
                                        $ciclo =  $imovel->fatura_ciclo - date("d");?>
                                        @if($ciclo >= -5 &&  $ciclo <= 5)
                                        <div class="btn-group">
                                            <a href="{{ route('imovel.consumo', $imovel->id) }}" type="button" class="btn btn-success btn-flat"><i class="fa fa-tachometer"></i> <i class="fa fa-dollar"></i></a>
                                        </div>
                                        @endif
                                        @endis

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
