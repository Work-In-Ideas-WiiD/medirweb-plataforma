<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agrupamento;
use App\Models\Imovel;
use App\Http\Requests\Agrupamento\AgrupamentoSaveRequest;

class AgrupamentoController extends Controller
{

	public function __construct()
	{

		$this->middleware('auth');

	}

	public function index()
	{
		//
	}

	public function create()
	{
		if(!app('defender')->hasRoles('Administrador')){
			return view('error403');
		}

		$imoveis  = Imovel::pluck('IMO_NOME', 'IMO_ID');

		return view('agrupamento.cadastrar', ['imoveis' => $imoveis]);
	}

	public function store(AgrupamentoSaveRequest $request)
	{
		if(!app('defender')->hasRoles('Administrador')){
			return view('error403');
		}

		$dataForm = $request->all();

		$agrupamento = Agrupamento::create($dataForm);

		return redirect('/imovel')->with('success', 'Agrupamento cadastrado com sucesso.');
	}

	//public function show($id)
	//{
	//	$user = auth()->user()->USER_IMOID;
	//	$agrupamento    = Agrupamento::findorFail($id);
	//	$unidades       = Agrupamento::find($id)->getUnidades;
	//	$imovel         = Agrupamento::find($id)->imovel;

	//	if(!app('defender')->hasRoles('Administrador') && !($user == $imovel)){
	//        return view('error403');
	//    }

	//	return view('agrupamento.lista', ['agrupamento' => $agrupamento, 'unidades' => $unidades, 'imovel' => $imovel]);

	//}

	public function edit($id)
	{
		$agrupamento  = Agrupamento::find($id);

		if(is_null($agrupamento)){
            return redirect()->route('404');
        }

		$user = auth()->user()->USER_IMOID;
		$ID_IMO = $agrupamento->imovel->IMO_ID;
        if(app('defender')->hasRoles('Sindico') && !($user == $ID_IMO)){
            return view('error403');
        }
        if(!app('defender')->hasRoles(['Administrador', 'Sindico'])){
            return view('error403');
        }

		$imoveis  = Imovel::pluck('IMO_NOME', 'IMO_ID');


		return view('agrupamento.editar', compact('agrupamento', 'imoveis'));
	}

	public function update(Request $request, $id)
	{
		$agrupamento  = Agrupamento::find($id);

		if(is_null($agrupamento)){
            return redirect()->route('404');
        }

		$user = auth()->user()->USER_IMOID;
		$ID_IMO = $agrupamento->imovel->IMO_ID;
        if(app('defender')->hasRoles('Sindico') && !($user == $ID_IMO)){
            return view('error403');
        }
        if(!app('defender')->hasRoles(['Administrador', 'Sindico'])){
            return view('error403');
        }

		$dataForm = $request->all();

		$agrupamento->update($dataForm);

		return redirect('/imovel')->with('success', 'Agrupamento atualizado com sucesso.');
	}

	public function destroy(Request $request, $id)
	{
		if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

		Agrupamento::destroy($id);

		return redirect('/imovel')->with('success', 'Agrupamento deletado com sucesso.');
	}
}
