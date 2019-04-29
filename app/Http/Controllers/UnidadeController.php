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
use App\Charts\ConsumoCharts;
use Mail;

class UnidadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
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

        //ADICIONAR USUARIO COMUM
        $password = rand(100000,9999999);
        $dataFormUser['USER_IMOID'] = $request->UNI_IDIMOVEL;
        $dataFormUser['name'] = $request->UNI_RESPONSAVEL;
        $dataFormUser['email'] = $request->email;
        $dataFormUser['password'] = bcrypt($password);
        $dataFormUser['roles'] = array("4"); //COMUM

        $user = User::create($dataFormUser);

        $user->roles()->attach($dataFormUser['roles']);
        // fim - ADICIONAR USUARIO COMUM

        $imovelAll = Imovel::find($user->USER_IMOID);

        // ENVIAR EMAIL com a senha.
        Mail::send('email.senhaUser', ['nome' => $user->nome, 'email' => $user->email, 'senha' => $password], function($message) use ($user) {
            $message->from('suporte@medirweb.com.br', 'MedirWeb - Plataforma individualizadora');
            $message->to($user->email);
            $message->subject('Senha de acesso ao app');
        });
        // fim - enviar email

        $dataForm = $request->all();

        $dataForm['UNI_IDUSER'] = $user->id;

        $undiade = Unidade::create($dataForm);

        return redirect('/imovel')->with('success', 'Unidade cadastrada com sucesso.');
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

        $user = User::find($unidade->UNI_IDUSER);
        if(is_null($user)){
            $unidade['email'] = "";
            $unidade['rolesUNI'] = "";
        }else{
            $unidade['email'] = $user->email;

            // PEFIL EXTRA
            foreach ($user->roles as $roleUser) {
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

        }

        return view('unidade.editar', compact('unidade', 'imoveis', 'agrupamentos', 'prumadas', 'rolesUNI'));
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

        $user = User::find($unidade->UNI_IDUSER);

        if(is_null($user)){
          $u['id'] = 0;
        }else{
          $u['id'] = $user->id;
        }

        // VALIDAÇÃO SE EMAIL JA EXISTE
        $userALL = User::where('email', $request->email)->get();
        foreach ($userALL as $userALL1) {
            if(!($userALL1->id == $u['id'])){
                return redirect('/unidade/editar/'.$id)->with('error', 'Email já cadastrado em outro usuário do sistema!');
            }
        }
        // fim - VALIDAÇÃO SE EMAIL JA EXISTE

        if(is_null($user)){
            // Se o usuario não existe
            //ADICIONAR USUARIO COMUM
            $password = rand(100000,9999999);
            $dataFormUser['USER_IMOID'] = $unidade->UNI_IDIMOVEL;
            $dataFormUser['name'] = $unidade->UNI_RESPONSAVEL;
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

            $dataFormNew['UNI_IDUSER'] = $user->id;

            $unidade->update($dataFormNew);
        }else{
            //user name atualizar
            $dataFormUser['name'] = $request->UNI_RESPONSAVEL;
            $user->update($dataFormUser);
            //fim - name atualizar

            // Se tiver perfil extra
            $rolesUNIForm = $dataForm['rolesUNI'];
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
        }

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

    /*public function leituraUnidade($undd)
    {
    $user = auth()->user()->USER_IMOID;
    $ID_IMO = Unidade::find($undd)->imovel->IMO_ID;

    var_dump($ID_IMO);
    die;
    if(app('defender')->hasRoles('Sindico') && !($user == $ID_IMO)){
    return view('error403');
}
if(!app('defender')->hasRoles(['Administrador', 'Sindico'])){
return view('error403');
}

$unidade = Unidade::find($undd);

//var_dump($unidade->getPrumadas); die();
foreach ($unidade->getPrumadas as $prumada)
{
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_URL => 'http://192.168.130.4/api/leitura/'.$prumada->PRU_ID,
CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

$jsons = json_decode($resp);

//var_dump($jsons);
if(($jsons !== NULL ) && (count($jsons) > 13) && ($jsons['0'] !== '!'))
{
$metro_cubico = hexdec(''.$jsons['5'].''.$jsons['6'].'');

$litros = hexdec(''.$jsons['9'].''.$jsons['10'].'');

$mililitro = hexdec(''.$jsons['13'].''.$jsons['14'].'');

// var_dump($metro_cubico);
// var_dump($litros);
// var_dump($mililitro);

$subtotal = ($metro_cubico * 1000) + $litros;
$total = $subtotal.'.'.$mililitro.'';


$leitura = [
'LEI_IDPRUMADA' => $prumada->PRU_ID,
'LEI_METRO' => $metro_cubico,
'LEI_LITRO' => $litros,
'LEI_MILILITRO' => $mililitro,
'LEI_VALOR' => $total,
];

Leitura::create($leitura);
}
else
{
$prumada->PRU_STATUS = 0;
$prumada->save();
Session::flash('error', 'Leitura não pode ser realizada. Por favor, verifique a conexão.');
}


}

return redirect('unidade/ver/'.$undd);
}

public function ligarUnidade($undd)
{
if(!app('defender')->hasRoles('Administrador')){
return view('error403');
}

$unidade = Unidade::find($undd);

//var_dump($unidade->getPrumadas); die();
foreach ($unidade->getPrumadas as $prumada)
{
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_URL => 'http://192.168.130.4/api/ativacao/'.$prumada->PRU_ID,
CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

$jsons = json_decode($resp);

if(($jsons !== NULL ) && (count($jsons) > 13) && ($jsons['0'] !== '!'))
{
if($jsons[4] == '00')
{
$status = 1;
}
else
{
$status = 0;
}


$atualizacao = [
'PRU_STATUS' => $status,
];

$prumada->update($atualizacao);
}
else
{
$prumada->PRU_STATUS = 0;
$prumada->save();
Session::flash('error', 'Unidade não pode ser ligada. Por favor, verifique a conexão.');
}

}

return redirect('unidade/ver/'.$undd);
}

public function desligarUnidade($undd)
{

$unidade = Unidade::find($undd);

//var_dump($unidade->getPrumadas); die();
foreach ($unidade->getPrumadas as $prumada)
{
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_URL => 'http://192.168.130.4/api/corte/'.$prumada->PRU_ID,
CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

$jsons = json_decode($resp);

if(($jsons !== NULL ) && (count($jsons) > 13) && ($jsons['0'] !== '!'))
{
if($jsons[4] == '00')
{
$status = '1';
}
else
{
$status = '0';
}


$atualizacao = [
'PRU_STATUS' => $status,
];

$prumada->update($atualizacao);
}
else
{
$prumada->PRU_STATUS = 0;
$prumada->save();
Session::flash('error', 'Unidade não pode ser desligada. Por favor, verifique a conexão.');
}

}

return redirect('unidade/ver/'.$unidd);
}*/

}
