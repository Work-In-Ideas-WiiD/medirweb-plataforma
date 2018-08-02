<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Hello extends Controller
{
    //
    public function index()
    {
    	//
    	return "Hello world";
    }

    public function show($name)
    {
    	return view('hello',array('name' => $name));
    }

    public function cadastro()
    {
    	return view('cadastro/adicionar');	
    }

    public function postAdicionar(Request $request)
    {
    	var_dump(request('titulo'));
    	var_dump(request('conteudo'));
    }

}
