<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Falha;
use App\Models\Imovel;

class FalhaController extends Controller
{
    public function index()
    {
        if(app('defender')->hasRoles('Administrador'))
            $imoveis = Imovel::pluck('nome', 'id');
        else if(app('defender')->hasRoles(['Sindico', 'Secretário']))
            $imoveis = auth()->user()->imovel()->pluck('nome', 'id');
        else
            return abort(403, 'Você não tem permissão');
        
        return view('falha.index', compact('imoveis'));
    }

    public function retorno()
    {
        return 'abc';
    }
}
