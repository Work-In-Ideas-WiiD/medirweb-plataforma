<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imovel;
use App\Models\Agrupamento;
use App\Models\Unidade;
use App\Models\Prumada;
use App\Models\Timeline;

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


				$logado = auth()->user()->name;
				$timelineData = ["TIMELINE_IDPRUMADA" => $prumada->PRU_ID,
									"TIMELINE_USER" => $logado,
									"TIMELINE_DESCRICAO" => "criou novo equipamento #".$prumada->PRU_ID,
									"TIMELINE_ICON" => "fa fa-plus bg-green",
								];
				$timeline = Timeline::create($timelineData);

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

			$logado = auth()->user()->name;

			// TIMELINE - STATUS
			if (!($dataForm["PRU_STATUS"] == $prumada->PRU_STATUS)){

				if ($prumada->PRU_STATUS == '0') {
					$statusAntigo = 'Inativo';
				}else{
					$statusAntigo = "Ativo";
				}

				if ($dataForm["PRU_STATUS"] == '0') {
					$statusNovo = 'Inativo';
					$TIMELINE_ICON1 = "fa fa-close bg-red";
				}else{
					$statusNovo = "Ativo";
					$TIMELINE_ICON1 = "fa fa-check bg-green";
				}

				$TIMELINE_DESCRICAO1 = "atualizou o status do equipamento #".$id." de ".$statusAntigo." para ".$statusNovo;

				$timelineData1 = ["TIMELINE_IDPRUMADA" => $id,
	 							 "TIMELINE_USER" => $logado,
	 							 "TIMELINE_DESCRICAO" => $TIMELINE_DESCRICAO1,
	 							 "TIMELINE_ICON" => $TIMELINE_ICON1,
	 						 ];
	 		 	Timeline::create($timelineData1);
			}

			// TIMELINE - Nº de SERIAL
			if (!($dataForm["PRU_SERIAL"] == $prumada->PRU_SERIAL)){

				$timelineData2 = ["TIMELINE_IDPRUMADA" => $id,
	 							 "TIMELINE_USER" => $logado,
	 							 "TIMELINE_DESCRICAO" => "atualizou o 'NÚMERO DE SERIAL' do equipamento #".$id." de ".$prumada->PRU_SERIAL." para ".$dataForm["PRU_SERIAL"],
	 							 "TIMELINE_ICON" => "fa fa-pencil bg-yellow",
	 						 ];
	 		 	Timeline::create($timelineData2);
			}

			// TIMELINE - ID FUNCIONAL
			if (!($dataForm["PRU_IDFUNCIONAL"] == $prumada->PRU_IDFUNCIONAL)){

				$timelineData3 = ["TIMELINE_IDPRUMADA" => $id,
	 							 "TIMELINE_USER" => $logado,
	 							 "TIMELINE_DESCRICAO" => "atualizou o 'ID FUNCIONAL' do equipamento #".$id." de ".$prumada->PRU_IDFUNCIONAL." para ".$dataForm["PRU_IDFUNCIONAL"],
	 							 "TIMELINE_ICON" => "fa fa-pencil bg-yellow",
	 						 ];
	 		 	Timeline::create($timelineData3);
			}

			// TIMELINE - FABRICANTE
			if (!($dataForm["PRU_FABRICANTE"] == $prumada->PRU_FABRICANTE)){

				$timelineData4 = ["TIMELINE_IDPRUMADA" => $id,
	 							 "TIMELINE_USER" => $logado,
	 							 "TIMELINE_DESCRICAO" => "atualizou o 'FABRICANTE' do equipamento #".$id." de ".$prumada->PRU_FABRICANTE." para ".$dataForm["PRU_FABRICANTE"],
	 							 "TIMELINE_ICON" => "fa fa-pencil bg-yellow",
	 						 ];
	 		 	Timeline::create($timelineData4);
			}

			// TIMELINE - MODELO
			if (!($dataForm["PRU_MODELO"] == $prumada->PRU_MODELO)){

				$timelineData5 = ["TIMELINE_IDPRUMADA" => $id,
	 							 "TIMELINE_USER" => $logado,
	 							 "TIMELINE_DESCRICAO" => "atualizou o 'MODELO' do equipamento #".$id." de ".$prumada->PRU_MODELO." para ".$dataForm["PRU_MODELO"],
	 							 "TIMELINE_ICON" => "fa fa-pencil bg-yellow",
	 						 ];
	 		 	Timeline::create($timelineData5);
			}

			// TIMELINE - OPERADORA
			if (!($dataForm["PRU_OPERADORA"] == $prumada->PRU_OPERADORA)){

				$timelineData6 = ["TIMELINE_IDPRUMADA" => $id,
	 							 "TIMELINE_USER" => $logado,
	 							 "TIMELINE_DESCRICAO" => "atualizou o 'OPERADORA' do equipamento #".$id." de ".$prumada->PRU_OPERADORA." para ".$dataForm["PRU_OPERADORA"],
	 							 "TIMELINE_ICON" => "fa fa-pencil bg-yellow",
	 						 ];
	 		 	Timeline::create($timelineData6);
			}

			// PRUMADA - ATUALZAR
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

		 $logado = auth()->user()->name;
		 $timelineData = ["TIMELINE_IDPRUMADA" => $id,
							 "TIMELINE_USER" => $logado,
							 "TIMELINE_DESCRICAO" => "deletou equipamento #".$id,
							 "TIMELINE_ICON" => "fa fa-trash bg-red",
						 ];
		 $timeline = Timeline::create($timelineData);

 		 return redirect('/imovel')->with('success', 'Equipamento deletado com sucesso.');
 	 }
}
