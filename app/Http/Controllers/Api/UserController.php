<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artesaos\Defender\Facades\Defender;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\File;
use App\Models\Imovel;
use Hash;
use Mail;
use Str;
use App\Traits\UploadFile;
use App\Http\Requests\Api\User\LoginRequest;


class UserController extends Controller
{
    use UploadFile;

    public function login(LoginRequest $request)
    {
        $user = Defender::findRole('Comum')
                ->users()
                ->where('email', '=',  $request->email)
                ->whereNotNull('unidade_id')
                ->first();

        if ($user and Hash::check($request->password, $user->password)) {
            
            if (!$user->api_token) {
                $user->api_token = Str::random(80);
                $user->save();
            }

            return ['token' => $user->api_token];
        }
        

        return ['error' => 'Usuário ou senha inválidos'];
    }

    public function esqueciSenha(Request $request)
    {
        $user = Defender::findRole('Comum')
                ->users()
                ->where('email', '=',  $request->email)
                ->whereNotNull('unidade_id')
                ->first();

        if(!$user)
            return ['error' => 'E-mail inválido!'];
        

        // GERANDO UMA SENHA ALETORIA
        $password = rand(100000,9999999);

        // ATUALIZANDO NO BANCO NOVA SENHA
        $user->update(['password' => bcrypt($password)]);

        $imovel = $user->imovel;

        // ENVIAR EMAIL com a senha.
        Mail::send('email.senhaUser', ['imovel'=> $imovel->nome, 'nome' => $user->nome, 'email' => $user->email, 'senha' => $password], function($message) use ($user) {
            $message->from('suporte@medirweb.com.br', 'MedirWeb - Plataforma individualizadora');
            $message->to($user->email);
            $message->cc('linconaraujo@medirweb.com.br');
            $message->cc('i.v.nascimento.ti@gmail.com');
            $message->subject('Senha de acesso ao app');
        });

        return ['success' => 'Senha gerada com Sucesso!'];
    }

    public function showUsers(Request $request)
    {
        // PESQUISANDO USUARIO COMUM
        $roleComum = Defender::findRole(ucfirst('Comum'));
        $userComum = $roleComum->users()->find($request->user_id);

        if(!isset($userComum)){
            return response()->json(['error' => 'Usuário não existe!'], 400);
        }
        // fim

        //Exibir todos os perfil vinculado ao usuario comum encontrado
        $user = User::find($userComum->id);
        $user->roles;

        return response()->make($user);
    }

    public function updateUsers(Request $request)
    {
        $user = User::find($request->user_id);

        if(!isset($user)){
            return response()->json(['error' => 'Usuário não existe!'], 400);
        }

        $dataForm = $request->all();

        if($dataForm['password'] == '')
            unset($dataForm['password'] );
        else
            $dataForm['password'] = bcrypt($dataForm['password']);

        if($request->foto) {
            $dataForm['foto'] = $this->cropImage($request->foto, 'upload/usuarios/');

            ImageOptimizer::optimize('upload/usuarios/'.$dataForm['foto']);
        }

        $user->update($dataForm);

        return response()->make($user);
    }


}
