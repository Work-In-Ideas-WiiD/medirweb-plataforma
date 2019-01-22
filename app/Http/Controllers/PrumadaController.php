<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prumada;
use App\Models\Imovel;
use App\Models\Agrupamento;
use App\Models\Unidade;


class PrumadaController extends Controller
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
			$imoveis = ['' => 'Selecionar Imovel'];
			$_imoveis = Imovel::all();
			foreach($_imoveis as $imovel){
				$imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
			}

			//var_dump($imoveis);
			//die();

			return view('prumada.cadastrar', compact('imoveis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
				$dataForm = $request->all();
        $prumada = Prumada::create($dataForm);

        return redirect('/imovel')->with('success', 'Equipamento cadastrada com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

		public function showAgrupamento($id)
		{
				//$agrupamentos = Agrupamento::where('AGR_IDIMOVEL', $id)->pluck('AGR_NOME','AGR_ID')->toArray();

				$agrupamentos = Agrupamento::where('AGR_IDIMOVEL', $id)->get();

				if(is_null($agrupamentos)){
						return redirect( URL::previous() );
				}


				return json_encode($agrupamentos);
		}

		public function showUnidade($id)
		{
				//$agrupamentos = Agrupamento::where('AGR_IDIMOVEL', $id)->pluck('AGR_NOME','AGR_ID')->toArray();

				$unidades = Unidade::where('UNI_IDAGRUPAMENTO', $id)->get();

				if(is_null($unidades)){
						return redirect( URL::previous() );
				}


				return json_encode($unidades);
		}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
			$prumadas  = Prumada::findOrFail($id);

			if(is_null($prumadas)){
				return redirect( URL::previous() );
			}

			$_unidades = Unidade::where('UNI_ID', $prumadas->PRU_IDUNIDADE)->get();
			foreach($_unidades as $unidade){
				$unidades[$unidade->UNI_ID] = $unidade->UNI_NOME;
			}

			$_agrupamentos = Agrupamento::where('AGR_ID', $unidade->UNI_IDAGRUPAMENTO)->get();
			foreach($_agrupamentos as $agrupamento){
				$agrupamentos[$agrupamento->AGR_ID] = $agrupamento->AGR_NOME;
			}


			$_imoveis = Imovel::where('IMO_ID', $agrupamento->AGR_IDIMOVEL)->get();
			foreach($_imoveis as $imovel){
				$imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
			}

			return view('prumada.editar', compact( 'imoveis', 'unidades', 'agrupamentos', 'prumadas'));
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
			$prumada = Prumada::findOrFail($id);

			if(is_null($prumada)){
				return redirect( URL::previous() );
			}

			$dataForm = $request->all();

			$prumada->update($dataForm);

			return redirect('/imovel')->with('success', 'Equipamento atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
		 public function destroy(Request $request, $id)
 	 {

 		 Prumada::destroy($id);

 		 return redirect('/imovel')->with('success', 'Equipamento deletado com sucesso.');
 	 }

	 public function timeline()
	 {
			 return view('prumada.timeline');
	 }
}
