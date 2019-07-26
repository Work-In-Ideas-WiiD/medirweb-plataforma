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
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index(Request $request, $role = 'Administrador'){

        $order = $request->order ?? 'asc';

        $role = Defender::findRole(ucfirst($role));
        $usuarios = $role->users()->orderBy('name', $order)
        ->where('name', 'like', '%' . $request->like . '%')
        ->paginate($request->mostrar);

        return view('usuario.index', compact('usuarios', 'role'));
    }

    public function create()
    {

        $roles =[];
        $_roles = \Artesaos\Defender\Role::all();
        foreach($_roles as $role){
            if(!($role->id == 4))
                $roles[$role->id] = $role->name;

        }

        $imoveis = ['' => 'Selecionar Imovel'];

        foreach(Imovel::all() as $imovel)
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
      

        return view('usuario.create', compact('roles', 'imoveis'));
    }


    public function store(UserSaveRequest $request)
    {

        $dataForm = $request->all();

        if($request->hasFile('fotoUser')){
            $fileName = md5(uniqid().str_random()).'.'.$request->file('fotoUser')->extension();
            $dataForm['foto'] = $request->file('fotoUser')->move('upload/usuarios', $fileName)->getFilename();

            ImageOptimizer::optimize('upload/usuarios/'.$dataForm['foto']);
        }

        $dataForm['password'] = bcrypt($dataForm['password']);

        $user = User::create($dataForm);

        $user->roles()->attach($dataForm['roles']);

        return redirect('/usuario')->with('success', 'Usuário cadastrado com sucesso.');
    }

    public function edit(User $usuario)
    {
        $user = $usuario;

        $roles =[];
        $_roles = \Artesaos\Defender\Role::all();
        foreach($_roles as $role){
            if(!($role->id == 4))
                $roles[$role->id] = $role->name;

        }

        $imoveis = ['' => 'Selecionar Imovel'];
        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel)
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
        

        foreach ($user->roles as $roleUser) {
            if($roleUser->id == "4" )
                return redirect('/unidade/editar/'.$user->USER_UNIID)->with('error', 'Usuário COMUM é exclusivo do responsável da Unidade. Você só pode editar o seu NOME e E-mail!');

        }

        return view('usuario.edit', compact('user', 'roles', 'imoveis'));
    }

    public function perfil()
    {
    
        $user = auth()->user();

        $roles =[];
        $_roles = \Artesaos\Defender\Role::all();
        foreach($_roles as $role){
            if(!($role->id == 4))
                $roles[$role->id] = $role->name;

        }

        $imoveis = ['' => 'Selecionar Imovel'];

        foreach(Imovel::all() as $imovel)
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
        

        foreach ($user->roles as $roleUser) {
            if($roleUser->id == "4" )
                return redirect('/unidade/editar/'.$user->USER_UNIID)->withError('Usuário COMUM é exclusivo do responsável da Unidade. Você só pode editar o seu NOME e E-mail!');

        }

        return view('usuario.perfil', compact('user', 'roles', 'imoveis'));
    }

    public function update(UserEditRequest $request, User $usuario)
    {

        $dataForm = $request->all();

        if ($dataForm)
            $dataForm['password'] = bcrypt($dataForm['password']);

        if($request->hasFile('fotoUser')){
            $foto_path = public_path("upload/usuarios/".$usuario->foto);

            if (File::exists($foto_path))
                File::delete($foto_path);
 
            $fileName = md5(uniqid().str_random()).'.'.$request->file('fotoUser')->extension();
            $dataForm['foto'] = $request->file('fotoUser')->move('upload/usuarios', $fileName)->getFilename();

            ImageOptimizer::optimize('upload/usuarios/'.$dataForm['foto']);
        }

        $usuario->update($dataForm);

        if(key_exists('roles', $dataForm))
            $usuario->roles()->sync($dataForm['roles']);

       
        return back()->withSuccess('Usuário atualizado com sucesso.');
    }

    public function destroy(Request $request, User $usuario)
    {

        if(auth()->user()->id == $usuario->id)
            return redirect('/usuario')->withError('Não é permitido excluir a si próprio!');
    

        $foto_path = public_path("upload/usuarios/".$usuario->foto);

        if (File::exists($foto_path))
            File::delete($foto_path);

        $usuario->delete();

        return redirect('/usuario')->with('success', 'Usuário deletado com sucesso.');
    }
}
