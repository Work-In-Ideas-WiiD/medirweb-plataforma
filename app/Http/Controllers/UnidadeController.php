<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidade;
use App\Models\Leitura;
use App\Models\Agrupamento;

class UnidadeController extends Controller
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
        $agrupamentos = Agrupamento::where('AGR_IDIMOVEL',1)->pluck('AGR_NOME','AGR_ID')->toArray();

        return view('unidade.cadastrar', ['agrupamentos' => $agrupamentos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $unidade = new Unidade;
        $unidade->UNI_IDAGRUPAMENTO     = $request->input('UNI_IDAGRUPAMENTO');
        $unidade->UNI_IDIMOVEL          = $request->input('UNI_IDIMOVEL');
        $unidade->UNI_NOME              = $request->input('UNI_NOME');
        $unidade->UNI_RESPONSAVEL       = $request->input('UNI_RESPONSAVEL');
        $unidade->UNI_CPFRESPONSAVEL    = $request->input('UNI_CPFRESPONSAVEL');
        $unidade->UNI_TELRESPONSAVEL    = $request->input('UNI_TELRESPONSAVEL');
        $unidade->save();

        return redirect('/imovel')->with('success', 'Unidade cadastrada com sucesso.');
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
        $unidade        = Unidade::findorFail($id);
        $prumadas       = Unidade::find($id)->getPrumadas;
        $agrupamento    = Unidade::find($id)->agrupamento;
        $imovel         = Unidade::find($id)->imovel;
        $leituras       = Leitura::where('LEI_IDPRUMADA',$id)
                            ->orderBy('LEI_ID', 'desc')
                            ->get();
        $ultimaleitura =  Leitura::where('LEI_IDPRUMADA',$id)
                            ->orderBy('LEI_ID', 'desc')
                            ->first();

        //$ultimaleitura  = Unidade::find($id)->getPrumadas()->lastest();
        dd($leituras);

        //return view('unidade.lista', ['agrupamento' => $agrupamento, 'unidade' => $unidade, 'imovel' => $imovel, 'prumadas' => $prumadas, 'leituras' => $leituras, 'ultimaleitura' => $ultimaleitura]);
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
