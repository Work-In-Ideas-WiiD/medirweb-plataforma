<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Endereco;
use Illuminate\Support\Str;

use App\Http\Requests\Cliente\ClienteSaveRequest;
use Session;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use App\Http\Requests\Cliente\ClienteEditRequest;
use Illuminate\Support\Facades\File;

class ClienteController extends Controller
{

    public function index()
    {
        $clientes = Cliente::has('endereco.cidade.estado')
            ->with('endereco.cidade.estado')->get();

        return view('cliente.index', compact('clientes'));
    }

    public function create()
    {
        $estados = Estado::pluck('nome', 'id');

        $cidades = Cidade::whereEstadoId(1)->pluck('nome', 'id');

        return view('cliente.create', compact('estados', 'cidades'));
    }

    public function store(ClienteSaveRequest $data)
    {
        $endereco = new Endereco;
        $endereco->fill(
            $data->only('logradouro', 'complemento', 'numero', 'bairro', 'cidade_id', 'cep')
        );

        $endereco = $endereco->save();

        $cliente = new Cliente;

        $cliente->fill(
            $data->only('tipo', 'documento', 'nome_juridico', 'nome_fantasia', 'status')
        );

        if($data->hasFile('foto')) {
            $cliente->foto = Str::random(32).'.'.$data->file('foto')->extension();
            $data->file('foto')->storeAs('upload/clientes/', $cliente->foto);
        }

        $cliente->endereco_id = $endereco->id;
        $cliente->save();

        return back()->withSuccess('Cliente cadastrado com sucesso.');
    }

    public function show(Cliente $cliente)
    {
        $cliente = $cliente->with('endereco.cidade.estado')->first();

        return view('cliente.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        $cliente = $cliente->with('endereco.cidade.estado')->first();

        $estados = Estado::pluck('nome', 'id');

        $cidades = Cidade::where('estado_id', $cliente->endereco->cidade->estado->id)->pluck('nome', 'id');

        $imoveis = $cliente->imovel()->count();

        return view('cliente.edit', compact('cliente', 'cidades', 'estados', 'imoveis'));
    }

    public function update(ClienteEditRequest $data, Cliente $cliente)
    {
        $cliente->fill(
            $data->only('tipo', 'documento', 'nome_juridico', 'nome_fantasia', 'status')
        );

        $cliente->endereco->fill(
            $data->only('logradouro', 'complemento', 'numero', 'bairro', 'cidade_id', 'cep')
        );

        if($data->hasFile('foto')) {
            $cliente->foto = Str::random(32).'.'.$data->file('foto')->extension();
            $data->file('foto')->storeAs('upload/clientes/', $cliente->foto);
            $cliente->save();
        }

        return back()->withSuccess('Cliente atualizado com sucesso.');
    }

    public function destroy(Cliente $cliente)
    {
        $foto_path = public_path('upload/clientes/'.$cliente->foto);

        if (File::exists($foto_path))
            File::delete($foto_path);

        $cliente->delete();

        return back()->withSuccess('Cliente deletado com sucesso.');
    }
}
