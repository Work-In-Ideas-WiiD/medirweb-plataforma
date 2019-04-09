<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artesaos\Defender\Facades\Defender;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\File;
use App\Models\Imovel;
use App\Models\Unidade;
use Hash;
use Mail;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $role = 'Comum';
        $role = Defender::findRole(ucfirst($role));

        $user = $role->users()->where('email', '=',  $request->input('email'))->first();

        if(!isset($user)){
            return response()->json(['error' => 'Usuário não existe!'], 400);
        }

        if ($user->count() <= 0 || !Hash::check($request->input('password'), $user->password)) {
            return response()->json(['error' => 'Usuário ou senha inválidos'], 400);
        }

        return response()->json(response()->make($user), 200);
    }

    public function esqueciSenha(Request $request)
    {
        $role = 'Comum';
        $role = Defender::findRole(ucfirst($role));

        $user = $role->users()->where('email', '=',  $request->input('email'))->first();

        if(!isset($user)){
            return response()->json(['error' => 'E-mail inválido!'], 400);
        }

        // GERANDO UMA SENHA ALETORIA
        $password = rand(100000,9999999);

        // ATUALIZANDO NO BANCO NOVA SENHA
        $dataFormUser['password'] = bcrypt($password);
        $user->update($dataFormUser);

        // ENVIAR EMAIL com a senha.
        Mail::send('email.senhaUser', ['nome' => $user->nome, 'email' => $user->email, 'senha' => $password], function($message) use ($user) {
            $message->from('suporte@medirweb.com.br', 'MedirWeb - Plataforma individualizadora');
            $message->to($user->email);
            $message->cc('linconaraujo@medirweb.com.br');
            $message->cc('i.v.nascimento@gmail.com');
            $message->subject('Senha de acesso ao app');
        });

        return response()->json(['success' => 'Senha gerada com Sucesso!'], 200);
    }

    public function showUsers(Request $request)
    {
        $role = 'Comum';
        $role = Defender::findRole(ucfirst($role));

        $user = $role->users()->find($request->user_id);

        if(!isset($user)){
            return response()->json(['error' => 'Usuário não existe!'], 400);
        }

        return response()->json(response()->make($user), 200);
    }

    public function updateUsers(Request $request)
    {
        $id = $request->input('user_id');
        $user = User::find($id);

        if(!isset($user)){
            return response()->json(['error' => 'Usuário não existe!'], 400);
        }

        $dataForm = $request->all();

        if($dataForm['password'] == '')
        unset($dataForm['password'] );
        else
        $dataForm['password'] = bcrypt($dataForm['password']);

        if($request->hasFile('fotoUser')){
            $foto_path = public_path("upload/usuarios/".$user->foto);

            if (File::exists($foto_path)) {
                File::delete($foto_path);
            }

            $fileName = md5(uniqid().str_random()).'.'.$request->file('fotoUser')->extension();
            $dataForm['foto'] = $request->file('fotoUser')->move('upload/usuarios', $fileName)->getFilename();

            ImageOptimizer::optimize('upload/usuarios/'.$dataForm['foto']);
        }

        $user->update($dataForm);

        if(key_exists('roles', $dataForm))
        $user->roles()->sync($dataForm['roles']);

        // ATUALIZAR NOME RESPONSAVEL DA UNIDADE
        $unidade = Unidade::where('UNI_IDUSER', $id)->first();
        if(!is_null($unidade)){
            $dataFormUNI['UNI_RESPONSAVEL'] = $user->name;
            $dataFormUNI['UNI_TELRESPONSAVEL'] = $request->telefone;
            $dataFormUNI['UNI_CPFRESPONSAVEL'] = $request->cpf;
            $unidade->update($dataFormUNI);
        }
        // fim

        return response()->json(response()->make($user), 200);
    }


}
