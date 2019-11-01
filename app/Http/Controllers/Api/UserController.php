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
use App\Http\Requests\Api\User\ForgotRequest;
use App\Http\Requests\Api\User\UpdateRequest;


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

            return $user;
        }
        

        return ['error' => 'Usuário ou senha inválidos'];
    }

    public function forgot(ForgotRequest $request)
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
        Mail::send('email.senhaUser', ['imovel'=> $imovel->nome, 'nome' => $user->name, 'email' => $user->email, 'senha' => $password], function($message) use ($user) {
            $message->from('suporte@medirweb.com.br', 'MedirWeb - Plataforma individualizadora');
            $message->to($user->email);
            $message->cc('linconaraujo@medirweb.com.br');
            $message->cc('charlesegidio@gmail.com');
            $message->subject('Senha de acesso ao app');
        });

        return ['success' => 'Senha gerada com sucesso!'];
    }

    public function show(Request $request)
    {
        $user = User::find(auth()->id());
        $user->roles;

        return $user;
    }

    public function update(UpdateRequest $request)
    {
        $user = $request->user();
        $user->fill($request->except('password', 'foto'));

        if($request->password)
            $user->password = Hash::make($request->password);

        if($request->foto)
            $user->foto = $this->cropImage($request->foto, 'upload/usuarios/');

        $user->save();

        return $user;
    }

}
