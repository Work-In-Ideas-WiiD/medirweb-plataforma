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

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $clientes = Cliente::all();

        foreach($clientes as $cli)
        {
            $cli['CLI_ESTADO'] = $cli->estado->EST_ABREVIACAO;
            $cli['CLI_CIDADE'] = $cli->cidade->CID_NOME;
        }

        return view('cliente.listar', ['clientes' => $clientes]);
    }

    public function create()
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $estados = ['' => 'Selecionar Estado'];
        $_estados = Estado::all();
        foreach($_estados as $estado)
        $estados[$estado->EST_ID] = $estado->EST_NOME;

        //return view('cliente.cadastrar', ['' => ]);
        return view('cliente.cadastrar', compact('estados'));
    }

    public function store(ClienteSaveRequest $request)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $dataForm = $request->all();

        if($request->input('cnpj') != NULL)
        {
            $dataForm['CLI_DOCUMENTO'] = $request->input('cnpj');
            unset( $dataForm['cnpj'] );
        }
        else
        {
            if($request->input('cpf') != NULL)
            {
                $dataForm['CLI_DOCUMENTO'] = $request->input('cpf');
                unset( $dataForm['cpf'] );
            }
            else
            {
                $request->session()->flash('error', 'Por favor preencha o formulario com algum número de documento CNPJ ou CPF.');
                return redirect('/cliente/adicionar');
            }

        }

        if($request->hasFile('foto')){
            $fileName = md5(uniqid().str_random()).'.'.$request->file('foto')->extension();
            $dataForm['CLI_FOTO'] = $request->file('foto')->move('upload/clientes', $fileName)->getFilename();

            ImageOptimizer::optimize('upload/clientes/'.$dataForm['CLI_FOTO']);
        }


        $cliente = Cliente::create($dataForm);

        return redirect('cliente')->with('success', 'Cliente cadastrado com sucesso.');
    }

    public function show($id)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $cliente =  Cliente::findorFail($id);
        $cliente['CLI_CIDADE'] = Cliente::find($id)->cidade->CID_NOME;
        $cliente['CLI_ESTADO'] = Cliente::find($id)->estado->EST_ABREVIACAO;

        return view('cliente.visualizar', compact('cliente'));
    }

    public function edit($id)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $cliente = Cliente::findOrFail($id);

        if(is_null($cliente)){
            return redirect( URL::previous() );
        }

        $estados = ['' => 'Selecionar Estado'];
        $_estados = Estado::all();
        foreach($_estados as $estado)
        $estados[$estado->EST_ID] = $estado->EST_NOME;


        $cidades = ['' => 'Selecionar Estado'];
        $_cidades = Cidade::where('CID_IDESTADO', $cliente->CLI_ESTADO)->get();
        foreach($_cidades as $cidade)
        $cidades[$cidade->CID_ID] = $cidade->CID_NOME;

        $imoveis = $cliente->getImoveis()->count();

        return view('cliente.editar', compact('cliente', 'estados', 'imoveis', 'cidades'));
    }

    public function update(ClienteEditRequest $request, $id)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $dataForm = $request->all();

        $cliente = Cliente::findOrFail($id);

        if(is_null($cliente)){
            return redirect( URL::previous() );
        }

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

        return redirect('cliente')->with('success', 'Cliente atualizado com sucesso.');
    }

    public function destroy(Request $request, $id)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $cliente = Cliente::findOrFail($id);

        $foto_path = public_path("upload/clientes/".$cliente->CLI_FOTO);

        if (File::exists($foto_path)) {
            File::delete($foto_path);
        }

        Cliente::destroy($id);

        return redirect('cliente')->with('success', 'Cliente deletado com sucesso.');
    }
}
