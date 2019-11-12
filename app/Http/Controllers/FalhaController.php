<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Falha;
use App\Models\Imovel;

class FalhaController extends Controller
{
    public function index(Request $request)
    {
        $falhas = [];

        if(app('defender')->hasRoles('Administrador'))
            $imoveis = Imovel::pluck('nome', 'id');
        else if(app('defender')->hasRoles(['Sindico', 'Secretário']))
            $imoveis = auth()->user()->imovel()->pluck('nome', 'id');
        else
            return abort(403, 'Você não tem permissão');

        if (!empty($request->data_anterior) or !empty($request->data->atual)) {
            $falhas = Falha::with('prumada.unidade.imovel')
                ->whereDate('created_at', '>=', $request->data_anterior)
                ->whereDate('created_at', '<=', $request->data_atual)->get();
        }


        return view('falha.index', compact('imoveis', 'falhas'));
    }
}
