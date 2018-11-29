<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Cliente;
use App\Models\Imovel;
use App\Models\Prumada;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Dashboard */
        $datadehoje = Carbon::today();

        return view('dashboard.ver', ['datacalendario' => $datadehoje, 'total_clientes' => Cliente::count(), 'total_imovel' => Imovel::count(), 'ativos_hidrometros' => Prumada::where('PRU_STATUS', 1)->count()]);
    }

}
