<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imovel;

class ImovelController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('imovel.listar');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('imovel.cadastrar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
            'imo_nome' => 'required',
        ]);

       $imovel = new Imovel;
       $imovel->IMO_NOME = $request->input('imo_nome');
       $imovel->IMO_ENDERECO = $request->input('imo_endereco');
       $imovel->IMO_COMPLEMENTO = $request->input('imo_complemento');
       $imovel->IMO_NUMERO = $request->input('imo_numero');
       $imovel->IMO_BAIRRO = $request->input('imo_bairro');
       $imovel->IMO_IDCIDADE = $request->input('imo_idcidade');
       $imovel->IMO_IDESTADO = $request->input('imo_idestado');
       $imovel->IMO_CEP = $request->input('imo_cep');
       $imovel->IMO_RESPONSAVEIS = $request->input('imo_responsaveis');
       $imovel->IMO_TELEFONES = $request->input('imo_telefones');
       $imovel->save();

       return redirect('/imovel/cadastrar')->with('success', 'Imóvel cadastrado com sucesso.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $imovel =  Imovel::findorFail($id);

        $imovel['IMO_IDCIDADE'] = Imovel::find($id)->cidade->CID_NOME;
        $imovel['IMO_IDESTADO'] = Imovel::find($id)->estado->EST_ABREVIACAO;

        $agrupamentos = Imovel::find($id)->getAgrupamentos;

        return view('imovel.visualizar', ['imovel' => $imovel, 'agrupamentos' => $agrupamentos]);
    }

    public function show2($id)
    {
        $imovel =  Imovel::findorFail($id);

        $imovel['IMO_IDCIDADE'] = Imovel::find($id)->cidade->CID_NOME;
        $imovel['IMO_IDESTADO'] = Imovel::find($id)->estado->EST_ABREVIACAO;

        $agrupamentos = Imovel::find($id)->getAgrupamentos;

        return view('imovel.macrovisualizar', ['imovel' => $imovel, 'agrupamentos' => $agrupamentos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $imovel = Imovel::findOrFail($id);

        if(is_null($imovel)){
            return redirect( URL::previous() );
        }

        return view('imovel.editar', compact('imovel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $imovel = Imovel::findOrFail($id);

        if(is_null($imovel)){
            return redirect( URL::previous() );
        }

        $dataForm = $request->all();

        $imovel->update($dataForm);

        return redirect('imovel/ver/'. $imovel->IMO_ID);
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

    public function getImoveisLista(Request $request)
    {
        //return $request->IMO_IDESTADO;
        $imoveis =  Imovel::where('IMO_IDESTADO', $request->IMO_IDESTADO)
                            ->where('IMO_IDCIDADE', $request->IMO_IDCIDADE)
                            ->get();

        $retorno = array();
        foreach($imoveis as $imo)
        {
            $retorno[] = [
                'IMO_ID' => $imo->IMO_ID,
                'IMO_NOME' => $imo->IMO_NOME,
                'IMO_BAIRRO' => $imo->IMO_BAIRRO
            ];
        }

        //dd($imoveis);
        return response()->json(['imoveis'=>$retorno]);
    }
}

