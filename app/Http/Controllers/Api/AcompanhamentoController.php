<?php

namespace App\Http\Controllers\Api;

use App\Models\Acompanhamento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\UploadFile;

class AcompanhamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()->unidade->acompanhamento()->orderByDesc('id')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return auth()->user()->unidade->acompanhamento()->create([
            'foto' => $this->cropImage($request->foto, 'upload/acompanhamentos/'),
            'leitura' => $request->leitura,
        ]);
    }

}
