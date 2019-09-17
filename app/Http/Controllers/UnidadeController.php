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
use App\Http\Requests\Unidade\UnidadeUserSaveRequest;
use App\Http\Requests\Unidade\UnidadeUserEditRequest;
use App\Charts\ConsumoCharts;
use Mail;

class UnidadeController extends Controller
{
    public function create()
    {     
        $imoveis = Imovel::pluck('nome', 'id');

        return view('unidade.cadastrar', compact('imoveis'));
    }

    public function showAgrupamento($id)
    {
        $agrupamentos = Agrupamento::where('AGR_IDIMOVEL', $id)->get();

        if(is_null($agrupamentos)){
            return redirect( URL::previous() );
        }


        return json_encode($agrupamentos);
    }

    public function store(UnidadeSaveRequest $request)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $dataForm = $request->all();

        $unidade = Unidade::create($dataForm);

        return redirect('/unidade/editar/'.$unidade->UNI_ID)->withSuccess('Unidade cadastrada com sucesso.');
    }

    public function show(Unidade $unidade)
    {
        $prumadas       = Unidade::find($id)->getPrumadas;
        $agrupamento    = Unidade::find($id)->agrupamento;
        $imovel         = Unidade::find($id)->imovel;
        $leituras       = Leitura::where('LEI_IDPRUMADA',$id)
        ->orderBy('LEI_ID', 'desc')
        ->get();

        $ultimaleitura =  Leitura::where('LEI_IDPRUMADA',$id)
        ->orderBy('LEI_ID', 'desc')
        ->first();

        $duasUltimaLeituras =  Leitura::where('LEI_IDPRUMADA',$id)
        ->orderBy('LEI_ID', 'desc')
        ->skip(1)
        ->take(2)
        ->get();

        //Grafico

        // INICIALIZAÇÃO de arrays
        $consumoAnoAnterior = array();
        $consumoAnoAtual = array();
        // FIM - INICIALIZAÇÃO de arrays

        // RESULTADO DA PESQUISA CONSUMO AVANÇADO
        $hidromentros = Unidade::find($id)->getPrumadas;

        foreach ($hidromentros as $hidromentro)
        {
            // ARRAY GRAFICO CONSUMO MENSAL
            $anoAnterior = date("Y", strtotime('-1 year'));
            $anoAtual = date("Y");

            for ($mes=1; $mes <= 12; $mes++) {
                $leituraAnoAnterior = $hidromentro->getLeituras() ->where('created_at', '<=', date("Y-m-d", strtotime($anoAnterior."-".$mes."-31")).' 23:59:59')
                ->orderBy('created_at', 'desc')->first();

                $leituraAnoAtual = $hidromentro->getLeituras() ->where('created_at', '<=', date("Y-m-d", strtotime($anoAtual."-".$mes."-31")).' 23:59:59')
                ->orderBy('created_at', 'desc')->first();

                $arrayConsumoAnoAnterior = array($leituraAnoAnterior['LEI_METRO']);
                $arrayConsumoAnoAtual = array($leituraAnoAtual['LEI_METRO']);

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

        return view('unidade.visualizar', compact('agrupamento', 'unidade', 'imovel', 'prumadas', 'leituras', 'ultimaleitura', 'duasUltimaLeituras', 'grafico', 'consumoAnoAnterior', 'consumoAnoAtual'));
    }

    public function edit(Unidade $unidade)
    {
        $prumadas = Prumada::where('unidade_id', $unidade->id)->get();

        // PESQUISAR TODOS OS USUARIOS VINCULADOS À UNIDADE

        $users = $unidade->with('user:id,unidade_id,name,email')->find($unidade->id)->user ?? [];
        
        $imoveis = Imovel::pluck('nome', 'id');

        $agrupamentos = Agrupamento::pluck('nome', 'id');

        return view('unidade.editar', compact('unidade', 'agrupamentos', 'imoveis', 'prumadas', 'users'));
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

        return redirect('/imovel')->withSuccess("Unidade e Usuario {$unidade->nome_responsavel} deletado com sucesso.");
    }



    // USUARIO COMUM VINCULADO À UNIDADE

    public function create_user($id)
    {

      if(!app('defender')->hasRoles('Administrador')){
          return view('error403');
      }

      $unidade = Unidade::find($id);

      return view('unidade.create_user', compact('unidade'));
    }

    public function store_user(UnidadeUserSaveRequest $request)
    {

      if(!app('defender')->hasRoles('Administrador')){
          return view('error403');
      }

      //ADICIONAR USUARIO COMUM
      $password = rand(100000,9999999);
      $dataFormUser['USER_IMOID'] = $request->USER_IMOID;
      $dataFormUser['USER_UNIID'] = $request->USER_UNIID;
      $dataFormUser['name'] = $request->name;
      $dataFormUser['email'] = $request->email;
      $dataFormUser['password'] = bcrypt($password);
      $dataFormUser['roles'] = array("4"); //COMUM

      $user = User::create($dataFormUser);

      $user->roles()->attach($dataFormUser['roles']);
      // fim - ADICIONAR USUARIO COMUM

      $imovelAll = Imovel::find($user->USER_IMOID);

      // ENVIAR EMAIL com a senha.
      Mail::send('email.senhaUser', ['imovel'=> $imovelAll->IMO_NOME, 'nome' => $user->nome, 'email' => $user->email, 'senha' => $password], function($message) use ($user) {
          $message->from('suporte@medirweb.com.br', 'MedirWeb - Plataforma individualizadora');
          $message->to($user->email);
          $message->subject('Senha de acesso ao app');
      });
      // fim - enviar email


      return redirect('/unidade/editar/'.$request->USER_UNIID)->with('success', 'Usuário criado e Vinculado à essa unidade!');
    }

    public function edit_user($id, $id_user)
    {

      if(!app('defender')->hasRoles('Administrador')){
          return view('error403');
      }

      $unidade = Unidade::find($id);
      $user = User::find($id_user);

      // VALIDAÇÃO SE USUARIO NÃO FOR USUARIO COMUM
      $valUserComum = false;

      foreach ($user->roles as $roleUser) {
          if($roleUser->id == "4" ){
              $valUserComum = true;
          }
      }

      if(!$valUserComum){
          return redirect('/unidade/editar/'.$id)->with('error', 'Este Usuário não é Usuário Comum!');
      }
      // FIM - VALIDAÇÃO SE USUARIO NÃO FOR USUARIO COMUM

      // VALIDAÇÃO SE O USUARIO NÃO TIVER VINCULADO À UNIDADE
      if($user->USER_UNIID != $unidade->UNI_ID){
        return redirect('/unidade/editar/'.$id)->with('error', 'Este Usuário não esta vinculado a essa Unidade!');
      }
      // FIM

      // PERFIL EXTRA
      $roles =[];
      $_roles = \Artesaos\Defender\Role::all();
      foreach($_roles as $role){
          if(!($role->id == 4)){
              $roles[$role->id] = $role->name;
          }
      }
      // FIM - PERFIL EXTRA

      return view('unidade.edit_user', compact('unidade', 'user', 'roles'));
    }

    public function update_user(UnidadeUserEditRequest $request, $id, $id_user)
    {

      if(!app('defender')->hasRoles('Administrador')){
          return view('error403');
      }

      $user = User::find($id_user);

      // VALIDAÇÃO SE EMAIL JA EXISTE
      $userALL = User::where('email', $request->email)->get();
      foreach ($userALL as $userALL1) {
          if(!($userALL1->id == $user['id'])){
              return redirect('/unidade/editar/'.$id.'/user/editar/'.$id_user)->with('error', 'Email já cadastrado em outro usuário do sistema!');
          }
      }
      // fim - VALIDAÇÃO SE EMAIL JA EXISTE

      //user name atualizar
      $dataFormUser['name'] = $request->name;
      $user->update($dataFormUser);
      //fim - name atualizar

      // se mudar email
      if(!($request->email == $user->email)){
          $password = rand(100000,9999999);
          $dataFormUser['email'] = $request->email;
          $dataFormUser['password'] = bcrypt($password);

          $user->update($dataFormUser);

          $imovelAll = Imovel::find($user->USER_IMOID);

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
      $rolesForm = $request->roles;

      if($rolesForm == null){
          $rolesForm = array("4");
      }else{
          array_push($rolesForm, "4");
      }

      $user->roles()->sync($rolesForm);
      // fim --


      return redirect('/unidade/editar/'.$id)->with('success', 'Usuario atualizado com sucesso!');
    }

    public function destroy_user(Request $request, $id, $id_user)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        User::destroy($id_user);

        return redirect('/unidade/editar/'.$id)->with('success', 'Usuário deletado com sucesso.');
    }



    public function add_user_existente($id)
    {

      if(!app('defender')->hasRoles('Administrador')){
          return view('error403');
      }

      $unidade = Unidade::find($id);

      $users = ['' => 'Selecione Usuário'];
      $_users = User:: whereNull('USER_UNIID')->get();
      foreach($_users as $user){
        $users[$user->id] = $user->name;
      }

      return view('unidade.add_user_existente', compact('unidade', 'users'));
    }

    public function store_user_existente(Request $request)
    {

      if(!app('defender')->hasRoles('Administrador')){
          return view('error403');
      }

      if($request->name == null){
        return redirect('/unidade/editar/'.$request->USER_UNIID.'/user/existente')->with('error', 'Selecione um Usuário para ser vinculado a essa unidade!');
      }

      $user = User::find($request->name);

      $dataFormUser['USER_IMOID'] = $request->USER_IMOID;
      $dataFormUser['USER_UNIID'] = $request->USER_UNIID;

      $user->update($dataFormUser);


      // Adicionando como Usuário Comum
      $rolesForm = [];

      foreach ($user->roles as $roleUser) {
        array_push($rolesForm, $roleUser->id);
      }

      array_push($rolesForm, "4");

      $user->roles()->sync($rolesForm);
      // fim --

      return redirect('/unidade/editar/'.$request->USER_UNIID)->with('success', 'Usuário vinculado à Unidade e à Usuário Comum com sucesso!');
    }



    public function desvincular_user(Request $request, $id, $id_user)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $user = User::find($id_user);
        $form["USER_UNIID"] = null;
        $user->update($form);

        // Removendo Usuário Comum
        $dataFormUser['roles'] = [];

        foreach ($user->roles()->where("id", "<>", "4")->get() as $roleUser) {
          array_push($dataFormUser['roles'], $roleUser->id);
        }

        if(key_exists('roles', $dataFormUser)){
          $user->roles()->sync($dataFormUser['roles']);
        }
        // fim --

        return redirect('/unidade/editar/'.$id)->with('success', 'Usuário desvinculado à essa Unidade, com sucesso!');
    }

}
