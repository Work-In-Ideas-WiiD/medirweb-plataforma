<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Cidade;
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

        return view('cliente.create', compact('estados'));
    }

    public function store(ClienteSaveRequest $request)
    {
        if(!app('defender')->hasRoles('Administrador'))
            return view('error403');
        
        $dataForm = $request->all();

        if($request->cnpj != null) {
            $dataForm['CLI_DOCUMENTO'] = $request->cnpj;
        } else if($request->cpf != null) {
            $dataForm['CLI_DOCUMENTO'] = $request->cpf;
        } else {
            return redirect('/cliente/adicionar')
                ->withError('Por favor preencha o formulario com algum número de documento CNPJ ou CPF.');
        }

        if($request->hasFile('foto')){
            $fileName = md5(uniqid().str_random()).'.'.$request->file('foto')->extension();
            $dataForm['CLI_FOTO'] = $request->file('foto')->move('upload/clientes', $fileName)->getFilename();

            ImageOptimizer::optimize('upload/clientes/'.$dataForm['CLI_FOTO']);
        }


        $cliente = Cliente::create($dataForm);

        return redirect('cliente')->with('success', 'Cliente cadastrado com sucesso.');
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

        $cidades = Cidade::pluck('nome', 'id');

        $imoveis = $cliente->imovel()->count();

        return view('cliente.edit', compact('cliente', 'estados', 'imoveis', 'cidades'));
    }

    public function update(ClienteEditRequest $request, Cliente $cliente)
    {
        $dataForm = $request->all();


        if($request->hasFile('foto')){
            $foto_path = public_path("upload/clientes/".$cliente->CLI_FOTO);

            if (File::exists($foto_path)) {
                File::delete($foto_path);
            }

            $fileName = md5(uniqid().str_random()).'.'.$request->file('foto')->extension();
            $dataForm['CLI_FOTO'] = $request->file('foto')->move('upload/clientes', $fileName)->getFilename();

            ImageOptimizer::optimize('upload/clientes/'.$dataForm['CLI_FOTO']);
        }

        $cliente->update($dataForm);

        return redirect('cliente')->withSuccess('Cliente atualizado com sucesso.');
    }

    public function destroy(Request $request, Cliente $cliente)
    {

        $foto_path = public_path("upload/clientes/".$cliente->CLI_FOTO);

        if (File::exists($foto_path))
            File::delete($foto_path);

        $cliente->delete();

        return redirect('cliente')->withSuccess('Cliente deletado com sucesso.');
    }
}
