<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agrupamento;
use App\Models\Imovel;
use App\Models\Unidade;
use App\Http\Requests\Agrupamento\AgrupamentoSaveRequest;


class AgrupamentoController extends Controller
{

	public function create()
	{
		$imoveis  = Imovel::pluck('nome', 'id');

		return view('agrupamento.create', compact('imoveis'));
	}

	public function store(AgrupamentoSaveRequest $request)
	{
		Agrupamento::create($request->all());

		return redirect('/imovel')->withSuccess('Agrupamento cadastrado com sucesso.');
	}

	
	public function edit(Agrupamento $agrupamento)
	{
		$imoveis  = Imovel::pluck('nome', 'id');

		return view('agrupamento.edit', compact('agrupamento', 'imoveis'));
	}

	public function update(Request $request, Agrupamento $agrupamento)
	{
		$agrupamento->update($request->all());

		return redirect('/imovel')->withSuccess('Agrupamento atualizado com sucesso.');
	}

	public function destroy(Agrupamento $agrupamento)
	{
		$agrupamento->delete();

		return redirect('/imovel')->withSuccess('Agrupamento deletado com sucesso.');
	}

	public function unidade($agrupamento_id)
    {
        return Unidade::whereAgrupamentoId($agrupamento_id)->pluck('nome', 'id');
    }
}
