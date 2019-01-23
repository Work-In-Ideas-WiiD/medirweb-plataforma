<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timeline;
use App\Models\Imovel;
use App\Models\Prumada;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timelines = Timeline::orderBy('created_at', 'desc')
                            ->paginate(5);

        return view('timeline.listar_prumada', compact('timelines'));
    }


    public function buscar()
    {
      $imoveis = ['' => 'Selecionar Imovel'];
			$_imoveis = Imovel::all();
			foreach($_imoveis as $imovel){
				$imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
			}

			return view('timeline.buscar_listar_prumada', compact('imoveis'));
    }


    public function getTimelineLista(Request $request)
    {
        $timelines = Timeline::where('TIMELINE_IDPRUMADA', $request->TIMELINE_IDPRUMADA)
                              ->orderBy('created_at', 'desc')
                              ->get();

        $retorno = array();
        foreach($timelines as $timeline)
        {
            $datecomplet = strtotime($timeline->created_at);
            $data = date("d/m/Y", $datecomplet);
            $hora = date("H:i", $datecomplet);

            $retorno[] = [
              'data'               => $data,
              'hora'               => $hora,
              'TIMELINE_USER'      => $timeline->TIMELINE_USER,
              'TIMELINE_DESCRICAO' => $timeline->TIMELINE_DESCRICAO,
              'TIMELINE_ICON'      => $timeline->TIMELINE_ICON,
            ];
        }

        return response()->json(['timelines'=>$retorno]);
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

			return view('timeline.cadastrar_prumada', compact('imoveis'));
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

        $timeline = Timeline::create($dataForm);

        return redirect('/timeline/equipamento')->with('success', 'Ocorrência cadastrada com sucesso.');
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


    public function showPrumada($id)
		{
				$prumadas = Prumada::where('PRU_IDUNIDADE', $id)->get();

				if(is_null($prumadas)){
						return redirect( URL::previous() );
				}

				return json_encode($prumadas);
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
