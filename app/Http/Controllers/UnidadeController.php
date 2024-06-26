<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidade;
use App\Models\Leitura;
use App\Models\Agrupamento;
use App\Models\Imovel;
use App\Models\Prumada;
use App\User;
use App\Http\Requests\Unidade\UnidadeSaveRequest;
use App\Http\Requests\Unidade\UnidadeEditRequest;
use App\Http\Requests\Unidade\UnidadeUserEditRequest;
use App\Charts\ConsumoCharts;
use App\Models\Acompanhamento;
use Mail;

class UnidadeController extends Controller
{
    public function create()
    {     
        $imoveis = Imovel::get(['nome', 'id']);

        $agrupamentos = $imoveis[0]->agrupamento->pluck('nome', 'id');

        $imoveis = $imoveis->pluck('nome', 'id');

        return view('unidade.create', compact('agrupamentos', 'imoveis'));
    }

    public function store(UnidadeSaveRequest $data)
    {
        Unidade::create(
            $data->except('telefone')
        )->telefone()->create([
            'etiqueta' => 'responsável',
            'numero' => $data->telefone
        ]);

        return back()->withSuccess('Unidade cadastrada com sucesso.');
    }

    public function show(Unidade $unidade)
    {
        $unidade = Unidade::with('telefone', 'prumada', 'agrupamento', 'imovel')->find($unidade->id);

        $leituras = $unidade->prumada[0]->leitura()->orderByDesc('id')->get();

        $ultimaleitura =  $leituras->first();

        $duasUltimaLeituras =  Leitura::where('prumada_id',$ultimaleitura->id)->orderBy('id', 'desc')->skip(1)->take(2)->get();

        //Grafico

        // INICIALIZAÇÃO de arrays
        $consumoAnoAnterior = array();
        $consumoAnoAtual = array();
        // FIM - INICIALIZAÇÃO de arrays

        // RESULTADO DA PESQUISA CONSUMO AVANÇADO
        $hidromentros = $unidade->prumada;

        foreach ($hidromentros as $hidromentro)
        {
            // ARRAY GRAFICO CONSUMO MENSAL
            $anoAnterior = date("Y", strtotime('-1 year'));
            $anoAtual = date("Y");

            for ($mes=1; $mes <= 12; $mes++) {
                $leituraAnoAnterior = $hidromentro->leitura() ->where('created_at', '<=', date("Y-m-d", strtotime($anoAnterior."-".$mes."-31")).' 23:59:59')
                ->orderByDesc('created_at')->first();

                $leituraAnoAtual = $hidromentro->leitura() ->where('created_at', '<=', date("Y-m-d", strtotime($anoAtual."-".$mes."-31")).' 23:59:59')
                ->orderByDesc('created_at')->first();

                $arrayConsumoAnoAnterior = array($leituraAnoAnterior['metro']);
                $arrayConsumoAnoAtual = array($leituraAnoAtual['metro']);

                array_push($consumoAnoAnterior, $arrayConsumoAnoAnterior);
                array_push($consumoAnoAtual, $arrayConsumoAnoAtual);
            }
            // FIM - ARRAY GRAFICO CONSUMO MENSAL

        }

        // GRAFICO CONSUMO MENSAL (TYPE: LINE)
        $grafico = new ConsumoCharts;
        $grafico->title("Media Consumo Mensal");
        $grafico->labels(['JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ']);
        $grafico->dataset($anoAnterior, 'line', $consumoAnoAnterior)->backgroundcolor('#3c8dbc');
        $grafico->dataset($anoAtual, 'line', $consumoAnoAtual)->backgroundcolor('#ffcc00');
        // GRAFICO CONSUMO MENSA (TYPE: LINE)

        // fim - Grafico

        return view('unidade.show', compact('unidade', 'leituras', 'ultimaleitura', 'duasUltimaLeituras', 'grafico', 'consumoAnoAnterior', 'consumoAnoAtual'));
    }

    public function edit(Unidade $unidade)
    {
        $prumadas = Prumada::where('unidade_id', $unidade->id)->get();

        // PESQUISAR TODOS OS USUARIOS VINCULADOS À UNIDADE

        $users = $unidade->with('user:id,unidade_id,name,email')->find($unidade->id)->user ?? [];
        
        $imoveis = Imovel::pluck('nome', 'id');

        $agrupamentos = Agrupamento::pluck('nome', 'id');

        $acompanhamentos = Acompanhamento::where('unidade_id', $unidade->id)->orderByDesc('created_at')->get();

        return view('unidade.edit', compact('unidade', 'agrupamentos', 'imoveis', 'prumadas', 'users', 'acompanhamentos'));
    }

    public function update(UnidadeEditRequest $data, Unidade $unidade)
    {
        $unidade->update(
            $data->except('telefone')
        );

        $unidade->telefone()->update([
            'numero' => $data->telefone
        ]);

        return back()->withSuccess('Unidade atualizado com sucesso.');
    }

    public function destroy(Request $request, Unidade $unidade)
    {
        $unidade->delete();

        return back()->withSuccess("Unidade e Usuario {$unidade->nome_responsavel} deletado com sucesso.");
    }

    public function edit_user(Unidade $unidade, User $user)
    {
        foreach ($user->roles as $roleUser) {
            if(!$roleUser->id == "4" )
                return back()->withError('Este Usuário não é Usuário Comum!');
        }

        // VALIDAÇÃO SE O USUARIO NÃO TIVER VINCULADO À UNIDADE
        if($user->unidade_id != $unidade->id)
            return back()->withError('Este Usuário não esta vinculado a essa Unidade!');

        // FIM

        // PERFIL EXTRA
        $roles = \Artesaos\Defender\Role::pluck('name', 'id');

        return view('unidade.edit_user', compact('unidade', 'user', 'roles'));
    }

    public function update_user(UnidadeUserEditRequest $request, Unidade $unidade, User $user)
    {
        $user->name = $request->name;

        // se mudar email
        if ($request->email !== $user->email) {
            $password = rand(100000,9999999);
            $user->email = $request->email;
            $user->password = bcrypt($password);

            $imovelAll = Imovel::find($user->id);

            // ENVIAR EMAIL com a senha.
            Mail::send('email.senhaUser', ['imovel'=> $imovelAll->IMO_NOME, 'nome' => $user->nome, 'email' => $user->email, 'senha' => $password], function($message) use ($user) {
                $message->from('suporte@medirweb.com.br', 'MedirWeb - Plataforma individualizadora');
                $message->to($user->email);
                $message->subject('Senha de acesso ao app');
            });
            // fim - enviar email
        }
      // fim - se mudar email

      // Se tiver perfil extra

      $user->save();

      $rolesForm = $request->roles;

      if($rolesForm == null){
          $rolesForm = array("4");
      }else{
          array_push($rolesForm, "4");
      }

      $user->roles()->sync($rolesForm);
      // fim --


      return back()->with('success', 'Usuario atualizado com sucesso!');
    }

    public function add_user_existente(Unidade $unidade)
    {
        $users = User::whereNull('unidade_id')->pluck('name', 'id');

        return view('unidade.add_user_existente', compact('unidade', 'users'));
    }

    public function store_user_existente(Request $data)
    {
        if(!$data->user == null)
            return back()->with('error', 'Selecione um Usuário para ser vinculado a essa unidade!');
      
      $user = User::findOrFail($data->user_id);

      $user->update($data->except('user_id'));


      // Adicionando como Usuário Comum
      $rolesForm = [];

      foreach ($user->roles as $roleUser) {
        array_push($rolesForm, $roleUser->id);
      }

      array_push($rolesForm, "4");

      $user->roles()->sync($rolesForm);
      // fim --

      return back()->withSuccess('Usuário vinculado à Unidade e à Usuário Comum com sucesso!');
    }



    public function desvincular_user(Request $request, User $user)
    {
        $user->update(['unidade_id' => null]);

        // Removendo Usuário Comum
        $dataFormUser['roles'] = [];

        foreach ($user->roles()->where("id", "<>", "4")->get() as $roleUser) {
          array_push($dataFormUser['roles'], $roleUser->id);
        }

        if(key_exists('roles', $dataFormUser)){
          $user->roles()->sync([]);
        }
        // fim --

        return back()->withSuccess('Usuário desvinculado à essa Unidade, com sucesso!');
    }

}
