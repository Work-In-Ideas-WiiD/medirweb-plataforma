<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Artesaos\Defender\Facades\Defender;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\User\UserSaveRequest;
use App\Http\Requests\User\UserEditRequest;
use App\Models\Imovel;

class UserController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }

    public function index(Request $request, $role = 'Administrador'){

        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $order = ($request->input('order')) ? $request->input('order') : 'asc';

        $role = Defender::findRole(ucfirst($role));
        $usuarios = $role->users()->orderBy('name', $order)
        ->where('name', 'like', '%' . $request->input('like') . '%')
        ->paginate($request->input('mostrar'));

        return view('admin.lista', compact('usuarios', 'role'));
    }

    public function create()
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $roles =[];
        $_roles = \Artesaos\Defender\Role::all();
        foreach($_roles as $role)
        $roles[$role->id] = $role->name;

        $imoveis = ['' => 'Selecionar Imovel'];
        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel){
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
        }

        return view('admin.criar', compact('roles', 'imoveis'));
    }

    public function create_user()
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $roles =[];
        $_roles = \Artesaos\Defender\Role::all();
        foreach($_roles as $role)
        $roles[$role->id] = $role->name;

        $imoveis = ['' => 'Selecionar Imovel'];
        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel){
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
        }

        return view('admin.criar_user', compact('roles', 'imoveis'));
    }

    public function store(UserSaveRequest $request)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $dataForm = $request->all();

        $dataForm['password'] = bcrypt($dataForm['password']);

        $user = User::create($dataForm);

        $user->roles()->attach($dataForm['roles']);

        $request->session()->flash('message-success', 'Administrador cadastrado com sucesso!');

        return redirect()->route('usuario.index');
    }

    public function show(User $user)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $this->middleware(['auth', 'needsRole:Administrador']);

    }

    public function edit($id)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $user = User::findOrFail($id);

        if(is_null($user)){
            return redirect( URL::previous() );
        }

        $roles =[];
        $_roles = \Artesaos\Defender\Role::all();
        foreach($_roles as $role)
        $roles[$role->id] = $role->name;

        $imoveis = ['' => 'Selecionar Imovel'];
        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel){
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
        }

        return view('admin.editar', compact('user', 'roles', 'imoveis'));
    }

    public function edit_user($id)
    {
        $user = auth()->user()->id;
        if(!app('defender')->hasRoles('Administrador') && !($user == $id)){
            return view('error403');
        }

        $user = User::findOrFail($id);

        if(is_null($user)){
            return redirect( URL::previous() );
        }

        $roles =[];
        $_roles = \Artesaos\Defender\Role::all();
        foreach($_roles as $role)
        $roles[$role->id] = $role->name;

        $imoveis = ['' => 'Selecionar Imovel'];
        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel){
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
        }

        return view('admin.editar_user', compact('user', 'roles', 'imoveis'));
    }

    public function update(UserEditRequest $request,  $id)
    {
        $user = auth()->user()->id;
        if(!app('defender')->hasRoles('Administrador') && !($user == $id)){
            return view('error403');
        }

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

        if(!app('defender')->hasRoles('Administrador')){
            return redirect('/user/editar/'.$id)->with('success', 'Usuário atualizado com sucesso.');
        }

        return redirect()->route('usuario.index');
    }

    public function destroy(Request $request, $id)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        User::destroy($id);

        $request->session()->flash('message-success', 'Administrador deletado com sucesso!');
        return redirect()->route('usuario.index');
    }
}
