@extends('adminlte::page')

@section('title', 'MedirWeb')

@section('content_header')
<h1>Imóveis<small>Lista de Imoveís</small></h1>

<ol class="breadcrumb">
  <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
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
                  <th>CNPJ</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($imoveis as $imovel)
                <tr>
                  <td>{{ $imovel->IMO_ID  }}</td>
                  <td>{{ $imovel->IMO_NOME }}</td>
                  <td>{{ $imovel->IMO_CNPJ }}</td>
                  <td>

                    <?php // Botão visualizar ?>
                    <div class="btn-group">
                      <a href="{{ route('Ver Imovel', ['imovel' => $imovel->IMO_ID]) }}" type="button" class="btn btn-info btn-flat"><i class="fa fa-eye"></i></a>
                    </div>

                    <?php // Botão editar ?>
                    <div class="btn-group">
                      <a href="" type="button" class="btn btn-warning btn-flat"><i class="fa fa-pencil"></i></a>
                    </div>

                    <?php // Botão deletar ?>
                    <div class="btn-group">
                      <?php $deleteForm = "delete-form-{$loop->index}"; ?>
                      <a class="btn btn-danger btn-flat" data-toggle="modal" data-target="#delete_user_ID{{$imovel->IMO_ID}}"><i class="fa fa-trash-o"></i></a>

                      <?php // modal deletar ?>
                      <div class="modal fade" id="delete_user_ID{{$imovel->IMO_ID }}" tabindex="-1" role="dialog" aria-labelledby="delete_user_ID{{$imovel->IMO_ID}}Label" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title text-primary" id="delete_user_ID{{$imovel->IMO_ID}}Label"><i class="fa fa-trash-o"></i> Deletar Cliente</h4>
                            </div>
                            <div class="modal-body">

                              <p class="alert alert-danger">Tem certeza que deseja excluir imóvel "{{ $imovel->IMO_NOME }}" ?</p>
                              <div class="form-actions">
                                <a href="{{ route('usuario.destroy', ['usuario' => $imovel->IMO_ID]) }}" onclick="event.preventDefault(); document.getElementById('{{$deleteForm}}').submit();" class="btn btn-danger btn-flat">SIM</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">NÃO</button>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>

                      {!! Form::open(['route' => ['usuario.destroy', 'usuario' => $imovel->IMO_ID], 'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display:none']) !!}
                      {!! Form::close() !!}

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
