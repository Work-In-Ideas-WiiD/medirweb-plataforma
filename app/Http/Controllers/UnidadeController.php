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
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create()
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $imoveis = ['' => 'Selecionar Imovel'];
        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel)
        $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;

        return view('unidade.cadastrar', ['imoveis' => $imoveis]);
    }

    public function showAgrupamento($id)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        //$agrupamentos = Agrupamento::where('AGR_IDIMOVEL', $id)->pluck('AGR_NOME','AGR_ID')->toArray();

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

        return redirect('/unidade/editar/'.$unidade->UNI_ID)->with('success', 'Unidade cadastrada com sucesso.');
    }

    public function show($id)
    {
        $unidade        = Unidade::find($id);

        if(is_null($unidade)){
            return redirect()->route('404');
        }

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

    public function edit($id)
    {
        $unidade  = Unidade::find($id);

        if(is_null($unidade)){
            return redirect()->route('404');
        }

        $user = auth()->user()->USER_IMOID;
        $ID_IMO = $unidade->agrupamento->imovel->IMO_ID;
        if(app('defender')->hasRoles('Sindico') && !($user == $ID_IMO)){
            return view('error403');
        }
        if(!app('defender')->hasRoles(['Administrador', 'Sindico'])){
            return view('error403');
        }

        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel){
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
        }

        $_agrupamentos = Agrupamento::all();
        foreach($_agrupamentos as $agrupamento){
            $agrupamentos[$agrupamento->AGR_ID] = $agrupamento->AGR_NOME;
        }

        $prumadas = Prumada::where('PRU_IDUNIDADE', $unidade->UNI_ID)->get();

        // PESQUISAR TODOS OS USUARIOS VINCULADOS À UNIDADE
        $userVinculado = User::where('USER_UNIID', $id)->get();

        return view('unidade.editar', compact('unidade', 'imoveis', 'agrupamentos', 'prumadas', 'userVinculado'));
    }

    public function update(UnidadeEditRequest $request, $id)
    {
        $unidade  = Unidade::find($id);

        if(is_null($unidade)){
            return redirect()->route('404');
        }

        $user = auth()->user()->USER_IMOID;
        $ID_IMO = $unidade->agrupamento->imovel->IMO_ID;
        if(app('defender')->hasRoles('Sindico') && !($user == $ID_IMO)){
            return view('error403');
        }
        if(!app('defender')->hasRoles(['Administrador', 'Sindico'])){
            return view('error403');
        }

        $dataForm = $request->all();

        $unidade->update($dataForm);

        return redirect('/unidade/editar/'.$id)->with('success', 'Unidade atualizado com sucesso.');
    }

    public function destroy(Request $request, $id)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $unidade = Unidade::find($id);

        User::destroy($unidade->UNI_IDUSER);

        Unidade::destroy($id);

        return redirect('/imovel')->with('success', 'Unidade e Usuario "'.$unidade->UNI_RESPONSAVEL.'" deletado com sucesso.');
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
      /*Mail::send('email.senhaUser', ['imovel'=> $imovelAll->IMO_NOME, 'nome' => $user->nome, 'email' => $user->email, 'senha' => $password], function($message) use ($user) {
          $message->from('suporte@medirweb.com.br', 'MedirWeb - Plataforma individualizadora');
          $message->to($user->email);
          $message->subject('Senha de acesso ao app');
      });*/
      // fim - enviar email


      return redirect('/unidade/editar/'.$request->USER_UNIID)->with('success', 'Usuário criado e Vinculado à essa unidade!');
    }

    public function add_user_existente($id)
    {

      if(!app('defender')->hasRoles('Administrador')){
          return view('error403');
      }

      $unidade = Unidade::find($id);

      $user = User::all();

      return view('unidade.add_user_existente', compact('unidade', 'user'));
    }

    public function edit_user($id, $id_user)
    {

      if(!app('defender')->hasRoles('Administrador')){
          return view('error403');
      }

      $unidade = Unidade::find($id);
      $user = User::find($id_user);

      /*foreach ($user->roles as $roleUser) {
          if($roleUser->id != "4" ){
              return redirect('/unidade/editar/'.$id)->with('error', 'Este Usuário não é Usuário Comum!');
          }
      }*/

      if($user->USER_UNIID != $unidade->UNI_ID){
        return redirect('/unidade/editar/'.$id)->with('error', 'Este Usuário não esta vinculado a essa Unidade!');
      }

      // PERFIL EXTRA
      foreach ($user->roles()->where("id", "<>", "4")->get() as $roleUser) {
          $unidade['rolesUNI'] = $roleUser->id;
      }

      $rolesUNI = ['' => '-- Sem Perfil Extra --'];
      $_roles = \Artesaos\Defender\Role::all();
      foreach($_roles as $role){
          if(!($role->id == 4)){
              $rolesUNI[$role->id] = $role->name;
          }
      }
      //

      return view('unidade.edit_user', compact('unidade', 'user', 'rolesUNI'));
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
          /*Mail::send('email.senhaUser', ['imovel'=> $imovelAll->IMO_NOME, 'nome' => $user->nome, 'email' => $user->email, 'senha' => $password], function($message) use ($user) {
              $message->from('suporte@medirweb.com.br', 'MedirWeb - Plataforma individualizadora');
              $message->to($user->email);
              $message->subject('Senha de acesso ao app');
          });*/
          // fim - enviar email
      }
      // fim - se mudar email

      // Se tiver perfil extra
      $rolesUNIForm = $request->rolesUNI;
      foreach ($rolesUNIForm as $key => $rolesUNI) {
          if(empty($rolesUNI)){
              $dataFormUser['roles'] = array("4");
          }else{
              $dataFormUser['roles'] = array("4", $rolesUNI);
          }
      }

      if(key_exists('roles', $dataFormUser))
      $user->roles()->sync($dataFormUser['roles']);
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

}
