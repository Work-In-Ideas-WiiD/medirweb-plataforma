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

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();

        foreach($clientes as $cli)
        {
            $cli['CLI_ESTADO'] = $cli->estado->EST_ABREVIACAO;
            $cli['CLI_CIDADE'] = $cli->cidade->CID_NOME;
        }

        return view('cliente.listar', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = ['' => 'Selecionar Estado'];
        $_estados = Estado::all();
        foreach($_estados as $estado)
            $estados[$estado->EST_ID] = $estado->EST_NOME;

        //return view('cliente.cadastrar', ['' => ]);
        return view('cliente.cadastrar', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteSaveRequest $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteEditRequest $request, $id)
    {
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
        } else
            $request->offsetUnset('foto');

        $dataForm = $request->all();

        $cliente->update($dataForm);

        return redirect('cliente')->with('success', 'Administrador atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
