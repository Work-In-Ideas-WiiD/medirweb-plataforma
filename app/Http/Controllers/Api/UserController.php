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

    public function updateUsers(Request $request)
    {
        $user = User::find($request->input('user_id'));
        if(!$user)
        {
            return response()->json(['error' => 'Usuário não encontrado!'], 400);
        }

        if ($request->input('foto')) {
            $this->destroyFile($user, 'foto', 'uploads/fotos/');
            $request->merge(['foto' => $this->cropImage($request->input('foto'), 'uploads/fotos/')]);
        } else
            $request->offsetUnset('foto');

        if ($request->input('doc_rg')) {
            $this->destroyFile($user, 'doc_rg', 'uploads/docs/');
            $request->merge(['doc_rg' => $this->cropImage($request->input('doc_rg'), 'uploads/docs/')]);
        } else
            $request->offsetUnset('doc_rg');

        if ($request->input('doc_end')) {
            $this->destroyFile($user, 'doc_end', 'uploads/docs/');
            $request->merge(['doc_end' => $this->cropImage($request->input('doc_end'), 'uploads/docs/')]);
        } else
            $request->offsetUnset('doc_end');

        $dataForm = $request->all();

        if(!isset($dataForm['password']) || $dataForm['password'] == '')
            unset($dataForm['password'] );
        else
            $dataForm['password'] = bcrypt($dataForm['password']);

        $user->update($dataForm);

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
