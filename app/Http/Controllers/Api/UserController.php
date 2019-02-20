<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artesaos\Defender\Facades\Defender;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Hash;
use Mail;

class UserController extends Controller
{

    public function index()
    {
        //
    }

    public function getUsers($id)
    {
        $role = 'Comum';
        $role = Defender::findRole(ucfirst($role));

        $user = $role->users()->find($id);
        if(!$user)
        {
            return response()->json(['error' => 'Usuário não encontrado!'], 400);
        }



        return response()->json($user, 200);
    }

    public function login(Request $request)
    {
        $role = 'Comum';
        $role = Defender::findRole(ucfirst($role));

        $user = $role->users()->where('email', '=',  $request->input('email'))->first();

        if(!isset($user))
        {
            return response()->json(['error' => 'Usuário não existe!'], 400);
        }

        if ($user->count() <= 0 || !Hash::check($request->input('password'), $user->password)) {

            return response()->json(['error' => 'Usuário ou senha inválidos'], 400);
        }

        return response()->json(response()->make($user), 200);
    }


    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }
}
