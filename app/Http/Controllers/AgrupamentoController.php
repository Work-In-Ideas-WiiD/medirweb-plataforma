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

		$agrupamento = Agrupamento::create($request->all());

		return redirect('/imovel')->with('success', 'Agrupamento cadastrado com sucesso.');
	}

	
	public function edit(Agrupamento $agrupamento)
	{
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

	public function update(Request $request, Agrupamento $agrupamento)
	{
		$user = auth()->user()->USER_IMOID;
		$ID_IMO = $agrupamento->imovel->IMO_ID;
        if(app('defender')->hasRoles('Sindico') && !($user == $ID_IMO)){
            return view('error403');
        }
        if(!app('defender')->hasRoles(['Administrador', 'Sindico'])){
            return view('error403');
        }


		$agrupamento->update($request->all());

		return redirect('/imovel')->with('success', 'Agrupamento atualizado com sucesso.');
	}

	public function destroy(Request $request, Agrupamento $agrupamento)
	{
		if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

		$agrupamento->delete();

		return redirect('/imovel')->with('success', 'Agrupamento deletado com sucesso.');
	}
}
