<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agrupamento;
use App\Models\Imovel;

class AgrupamentoController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $imoveis         = Imovel::pluck('IMO_NOME', 'IMO_ID');

        return view('agrupamento.cadastrar', ['imoveis' => $imoveis]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agrupamento = new Agrupamento;
        $agrupamento->AGR_IDIMOVEL = $request->input('AGR_IDIMOVEL');
        $agrupamento->AGR_NOME = $request->input('AGR_NOME');
        $agrupamento->save();

        return redirect('/imovel')->with('success', 'Agrupamento cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agrupamento    = Agrupamento::findorFail($id);
        $unidades       = Agrupamento::find($id)->getUnidades;
        $imovel         = Agrupamento::find($id)->imovel;

        return view('agrupamento.lista', ['agrupamento' => $agrupamento, 'unidades' => $unidades, 'imovel' => $imovel]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
