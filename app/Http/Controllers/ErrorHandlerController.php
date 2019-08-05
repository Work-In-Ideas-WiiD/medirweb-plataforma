<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ErrorHandlerController extends Controller
{

    public function errorCode404()
    {
        return view('error404');
    }

    public function errorCode500()
    {
        return view('error500');
    }
}
