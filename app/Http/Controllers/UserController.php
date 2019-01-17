<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Artesaos\Defender\Facades\Defender;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\User\UserSaveRequest;
use App\Http\Requests\User\UserEditRequest;

class UserController extends Controller
{
  public function __construct()
  {

    $this->middleware('auth');

  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request, $role = 'Administrador'){

    $order = ($request->input('order')) ? $request->input('order') : 'asc';

    $role = Defender::findRole(ucfirst($role));
    $usuarios = $role->users()->orderBy('name', $order)
    ->where('name', 'like', '%' . $request->input('like') . '%')
    ->paginate($request->input('mostrar'));

    return view('admin.lista', compact('usuarios', 'role'));
  }
  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $roles =[];
    $_roles = \Artesaos\Defender\Role::all();
    foreach($_roles as $role)
    $roles[$role->id] = $role->name;

    return view('admin.criar', compact('roles'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(UserSaveRequest $request)
  {

    $dataForm = $request->all();

    $dataForm['password'] = bcrypt($dataForm['password']);

    $user = User::create($dataForm);

    $user->roles()->attach($dataForm['roles']);

    $request->session()->flash('message-success', 'Administrador cadastrado com sucesso!');

    return redirect()->route('usuario.index');
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\User  $user
  * @return \Illuminate\Http\Response
  */
  public function show(User $user)
  {
    $this->middleware(['auth', 'needsRole:Administrador']);

  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\User  $user
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {

    $user = User::findOrFail($id);

    if(is_null($user)){
      return redirect( URL::previous() );
    }

    $roles =[];
    $_roles = \Artesaos\Defender\Role::all();
    foreach($_roles as $role)
    $roles[$role->id] = $role->name;

    return view('admin.editar', compact('user', 'roles'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\User  $user
  * @return \Illuminate\Http\Response
  */
  public function update(UserEditRequest $request,  $id)
  {
    $user = User::findOrFail($id);

    if(is_null($user)){
      return redirect( URL::previous() );
    }

    $dataForm = $request->all();

    if($dataForm['password'] == '')
    unset($dataForm['password'] );
    else
    $dataForm['password'] = bcrypt($dataForm['password']);

    $user->update($dataForm);

    if(key_exists('roles', $dataForm))
            $user->roles()->sync($dataForm['roles']);

    $request->session()->flash('message-success', 'Administrador atualizado com sucesso!');

    return redirect()->route('usuario.index');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\User  $user
  * @return \Illuminate\Http\Response
  */
  public function destroy(Request $request, $id)
  {
    User::destroy($id);

    $request->session()->flash('message-success', 'Administrador deletado com sucesso!');
    return redirect()->route('usuario.index');
  }
}
