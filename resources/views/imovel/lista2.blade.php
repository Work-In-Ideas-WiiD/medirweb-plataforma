@extends('adminlte::page')

@section('title', 'MedirWeb')

@section('content_header')
    <h1>Imóveis <small>Lista de Imóveis</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
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
                </div>

                <div class='box-body'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <table id="lista-clientes" class="table table-bordered table-hover powertabela">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome completo/Razão social</th>
                                    <th>Cliente</th>
                                    <th>Cidade</th>
                                    <th>Estado</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($imoveis as $imo)
                                    <tr>
                                        <td>{{ $imo->IMO_ID  }}</td>
                                        <td>{{ $imo->IMO_NOME }}</td>
                                        <td>{{ $imo->administrador->CLI_NOMEJUR }}</td>
                                        <td>{{ $imo->cidade->CID_NOME }}</td>
                                        <td>{{ $imo->estado->EST_ABREVIACAO }}</td>
                                        @if ($imo->IMO_STATUS)
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

