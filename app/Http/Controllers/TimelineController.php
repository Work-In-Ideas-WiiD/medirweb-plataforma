<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timeline;
use App\Models\Imovel;
use App\Models\Prumada;
use Ping;
use App\Http\Requests\Timeline\TimelineSaveRequest;

class TimelineController extends Controller
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

        $timelines = Timeline::orderBy('created_at', 'desc')
        ->paginate(5);

        return view('timeline.listar_prumada', compact('timelines'));
    }


    public function buscar()
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $imoveis = ['' => 'Selecionar Imovel'];
        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel){
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
        }

        return view('timeline.buscar_listar_prumada', compact('imoveis'));
    }


    public function getTimelineLista(Request $request)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

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

    public function create()
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $imoveis = ['' => 'Selecionar Imovel'];
        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel){
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
        }

        return view('timeline.cadastrar_prumada', compact('imoveis'));
    }

    public function store(TimelineSaveRequest $request)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $dataForm = $request->all();

        $timeline = Timeline::create($dataForm);

        return redirect('/timeline/equipamento')->with('success', 'Ocorrência cadastrada com sucesso.');
    }

    public function showPrumada($id)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $prumadas = Prumada::where('PRU_IDUNIDADE', $id)->get();

        if(is_null($prumadas)){
            return redirect( URL::previous() );
        }

        return json_encode($prumadas);
    }

    public function serverTest()
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $imoveis = ['' => 'Selecionar Imovel'];
        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel){
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
        }

        return view('timeline.serverTest', compact('imoveis'));
    }

    public function getServerTest(Request $request)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        // FORMULARIO IMOVEL (GET)
        $imoveis = ['' => 'Selecionar Imovel'];
        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel){
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
        }
        // FIM - FORMULARIO IMOVEL (GET)

        // VALIDAÇÃO CAMPO IMOVEL
        if(empty($request->IMO_ID)){
            return redirect('/server/test')->with('error', 'Por Favor Selecione o Imóvel.');
        }
        // FIM - VALIDAÇÃO CAMPO IMOVEL

        $imovel = Imovel::find($request->IMO_ID);
        $url = $imovel->IMO_IP;

        // VALIDAÇÃO IP DO IMOVEL FOR VAZIO
        if(empty($url)){
            return redirect('/server/test')->with('error', 'Este Imovel não possui endereço de IP configurado!');
        }
        // FIM - VALIDAÇÃO IP DO IMOVEL FOR VAZIO

        $codigoHTTP = Ping::check($url);

        return view('timeline.serverTest', compact('imoveis', 'url', 'codigoHTTP'));
    }
}
