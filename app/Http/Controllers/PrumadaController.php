<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imovel;
use App\Models\Agrupamento;
use App\Models\Unidade;
use App\Models\Prumada;
use App\Models\Timeline;
use App\Http\Requests\Prumada\PrumadaSaveRequest;
use App\Http\Requests\Prumada\PrumadaEditRequest;

class PrumadaController extends Controller
{
	private $debug = true;

	private $raspberry_url = 'http://localhost:8000';

	public function create()
	{
		$imoveis = Imovel::pluck('nome', 'id');

		return view('prumada.cadastrar', compact('imoveis'));
	}

	public function store(PrumadaSaveRequest $request)
	{

		$dataForm = $request->all();
		$prumada = Prumada::create($dataForm);


		// Adicionar prumada no central raspberry
		$dadosCentral['EQP_IDUNI'] = $prumada->PRU_IDUNIDADE;
		$dadosCentral['EQP_IDPRU'] = $prumada->PRU_ID;
		$dadosCentral['EQP_IDFUNCIONAL'] = $prumada->PRU_IDFUNCIONAL;

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		
		if ($this->debug)
			curl_setopt($curl, CURLOPT_URL, "{$this->raspberry_url}/equipamentos/");
		else
			curl_setopt($curl, CURLOPT_URL, "http://{$prumada->unidade->imovel_id}/equipamentos/");
		
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $dadosCentral);

		$resposta = curl_exec($curl);
		curl_close($curl);
		// fim

		$timelineData = [
			"prumada_id" => $prumada->id,
			"user" => auth()->user()->name,
			"descricao" => "criou novo equipamento #".$prumada->id,
			"icone" => "fa fa-plus bg-green"
		];


		$timeline = Timeline::create($timelineData);

		// Sem comunicação com a central do imovel
		if($resposta == NULL){
				return redirect()->route('prumada.edit', $prumada->id)->withError(
				'Sem comunicação com a central do imovel! Tente novamente mais tarde no ATUALIZAR EQUIPAMENTO, para atualizar a base de dados!'
			);
		}
		//

		return redirect('/imovel')->withSuccess('Equipamento cadastrada com sucesso.');
	}

	public function showAgrupamento($id)
	{
		if(!app('defender')->hasRoles(['Administrador', 'Sindico'])){
			return view('error403');
		}

		$agrupamentos = Agrupamento::where('imovel_id', $id)->get();

		if(is_null($agrupamentos)){
			return redirect( URL::previous() );
		}

		return $agrupamentos;
	}

	public function showUnidade($id)
	{
		if(!app('defender')->hasRoles(['Administrador', 'Sindico'])){
			return view('error403');
		}

		$unidades = Unidade::where('UNI_IDAGRUPAMENTO', $id)->get();

		if(is_null($unidades)){
			return redirect( URL::previous() );
		}

		return $unidades;
	}

	public function edit(Prumada $prumada)
	{
		$_unidades = Unidade::where('id', $prumadas->unidade_id)->get();
		foreach($_unidades as $unidade){
			$unidades[$unidade->UNI_ID] = $unidade->UNI_NOME;
		}

		$_agrupamentos = Agrupamento::where('id', $unidade->agrupamento_id)->get();
		foreach($_agrupamentos as $agrupamento){
			$agrupamentos[$agrupamento->AGR_ID] = $agrupamento->nome;
		}

		$_imoveis = Imovel::where('id', $agrupamento->imovel_id)->get();
		foreach($_imoveis as $imovel){
			$imoveis[$imovel->IMO_ID] = $imovel->nome;
		}

		// PERMISSÃO DE USUARIO
		$user = auth()->user()->USER_IMOID;
		$ID_IMO = $imovel->IMO_ID;
		if(app('defender')->hasRoles('Sindico') && !($user == $ID_IMO)){
			return view('error403');
		}
		if(!app('defender')->hasRoles(['Administrador', 'Sindico'])){
			return view('error403');
		}


		return view('prumada.editar', compact( 'imoveis', 'unidades', 'agrupamentos', 'prumadas'));
	}

	public function update(PrumadaEditRequest $request, Prumada $prumada)
	{
		$dataForm = $request->all();

		$logado = auth()->user()->name;

		// TIMELINE - STATUS
		if (!($dataForm["PRU_STATUS"] == $prumada->PRU_STATUS)){

			if ($prumada->PRU_STATUS == '0') {
				$statusAntigo = 'Inativo';
			}else{
				$statusAntigo = "Ativo";
			}

			if ($dataForm["PRU_STATUS"] == '0') {
				$statusNovo = 'Inativo';
				$TIMELINE_ICON1 = "fa fa-close bg-red";
			}else{
				$statusNovo = "Ativo";
				$TIMELINE_ICON1 = "fa fa-check bg-green";
			}

			$TIMELINE_DESCRICAO1 = "atualizou o status do equipamento #".$id." de '<a>".$statusAntigo."</a>' para '<a>".$statusNovo."</a>'";

			$timelineData1 = [
				"TIMELINE_IDPRUMADA" => $id,
				"TIMELINE_USER" => $logado,
				"TIMELINE_DESCRICAO" => $TIMELINE_DESCRICAO1,
				"TIMELINE_ICON" => $TIMELINE_ICON1
			];
			Timeline::create($timelineData1);
		}

		// TIMELINE - Nº de SERIAL
		if (!($dataForm["PRU_SERIAL"] == $prumada->PRU_SERIAL)){

			$timelineData2 = [
				"TIMELINE_IDPRUMADA" => $id,
				"TIMELINE_USER" => $logado,
				"TIMELINE_DESCRICAO" => "atualizou o 'NÚMERO DE SERIAL' do equipamento #".$id." de '<a>".$prumada->PRU_SERIAL."</a>' para '<a>".$dataForm["PRU_SERIAL"]."</a>'",
				"TIMELINE_ICON" => "fa fa-pencil bg-yellow"
			];
			Timeline::create($timelineData2);
		}

		// TIMELINE - ID FUNCIONAL
		if (!($dataForm["PRU_IDFUNCIONAL"] == $prumada->PRU_IDFUNCIONAL)){

			$timelineData3 = [
				"TIMELINE_IDPRUMADA" => $id,
				"TIMELINE_USER" => $logado,
				"TIMELINE_DESCRICAO" => "atualizou o 'ID FUNCIONAL' do equipamento #".$id." de '<a>".$prumada->PRU_IDFUNCIONAL."</a>' para '<a>".$dataForm["PRU_IDFUNCIONAL"]."</a>'",
				"TIMELINE_ICON" => "fa fa-pencil bg-yellow"
			];
			Timeline::create($timelineData3);
		}

		// TIMELINE - FABRICANTE
		if (!($dataForm["PRU_FABRICANTE"] == $prumada->PRU_FABRICANTE)){

			$timelineData4 = [
				"TIMELINE_IDPRUMADA" => $id,
				"TIMELINE_USER" => $logado,
				"TIMELINE_DESCRICAO" => "atualizou o 'FABRICANTE' do equipamento #".$id." de '<a>".$prumada->PRU_FABRICANTE."</a>' para '<a>".$dataForm["PRU_FABRICANTE"]."</a>'",
				"TIMELINE_ICON" => "fa fa-pencil bg-yellow"
			];
			Timeline::create($timelineData4);
		}

		// TIMELINE - MODELO
		if (!($dataForm["PRU_MODELO"] == $prumada->PRU_MODELO)){

			$timelineData5 = [
				"TIMELINE_IDPRUMADA" => $id,
				"TIMELINE_USER" => $logado,
				"TIMELINE_DESCRICAO" => "atualizou o 'MODELO' do equipamento #".$id." de '<a>".$prumada->PRU_MODELO."</a>' para '<a>".$dataForm["PRU_MODELO"]."</a>'",
				"TIMELINE_ICON" => "fa fa-pencil bg-yellow"
			];
			Timeline::create($timelineData5);
		}

		// TIMELINE - OPERADORA
		if (!($dataForm["PRU_OPERADORA"] == $prumada->PRU_OPERADORA)){

			$timelineData6 = [
					"TIMELINE_IDPRUMADA" => $id,
					"TIMELINE_USER" => $logado,
					"TIMELINE_DESCRICAO" => "atualizou o 'OPERADORA' do equipamento #".$id." de '<a>".$prumada->PRU_OPERADORA."</a>' para '<a>".$dataForm["PRU_OPERADORA"]."</a>'",
					"TIMELINE_ICON" => "fa fa-pencil bg-yellow"
			];
			Timeline::create($timelineData6);
		}

		// TIMELINE - NOME
		if (!($dataForm["PRU_NOME"] == $prumada->PRU_OPERADORA)){

			$timelineData7 = [
				"TIMELINE_IDPRUMADA" => $id,
				"TIMELINE_USER" => $logado,
				"TIMELINE_DESCRICAO" => "atualizou o 'NOME' do equipamento #".$id." de '<a>".$prumada->PRU_NOME."</a>' para '<a>".$dataForm["PRU_NOME"]."</a>'",
				"TIMELINE_ICON" => "fa fa-pencil bg-yellow"
			];
			Timeline::create($timelineData7);
		}

		// PRUMADA - ATUALIZAR
		$prumada->update($dataForm);



		// PRUCURANDO prumada na central raspberry para pegar o id da prumada da central
		$chPruCentral = curl_init();
		curl_setopt($chPruCentral, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($chPruCentral, CURLOPT_URL, 'http://localhost:8000/equipamentos/');
		//curl_setopt($chPruCentral, CURLOPT_URL, 'http://'.$prumada->unidade->imovel->IMO_IP.'/equipamentos/');
		$getPruCentral_json = curl_exec($chPruCentral);
		curl_close($chPruCentral);


		// Sem comunicação com a central do imovel
		if($getPruCentral_json == NULL){
			return redirect()->route('prumada.edit', $prumada->id)->with('error',
				'Sem comunicação com a central do imovel! Tente novamente mais tarde para atualizar a base de dados!'
			);
		}
		//

		$getPruCentral = json_decode($getPruCentral_json, true);
		foreach ($getPruCentral as $key => $pruCentral) {
			if($pruCentral['EQP_IDPRU'] == $prumada->PRU_ID){
				$idPruCentral = $pruCentral['id'];
			}
		}
		// fim

		// Atualizar prumada no central raspberry
		$dadosCentral['EQP_IDUNI'] = $prumada->PRU_IDUNIDADE;
		$dadosCentral['EQP_IDPRU'] = $prumada->PRU_ID;
		$dadosCentral['EQP_IDFUNCIONAL'] = $prumada->PRU_IDFUNCIONAL;

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		
		if ($this->debug)
			curl_setopt($curl, CURLOPT_URL, "{$this->raspberry_url}/equipamentos/{$idPruCentral}/");
		else
			curl_setopt($curl, CURLOPT_URL, "http://{$prumada->unidade->imovel->ip}/equipamentos/{$idPruCentral}/");

		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $dadosCentral);
		$resposta = curl_exec($curl);
		curl_close($curl);
		// fim


		return redirect('/imovel')->withSuccess('Equipamento atualizado com sucesso.');
	}

	public function destroy(Request $request, Prumada $prumada)
	{
		$prumada->delete();

		$timelineData = [
			"TIMELINE_IDPRUMADA" => $prumada->id,
			"TIMELINE_USER" => auth()->user()->name,
			"TIMELINE_DESCRICAO" => "deletou equipamento #".$prumada->id,
			"TIMELINE_ICON" => "fa fa-trash bg-red"
		];

		$timeline = Timeline::create($timelineData);

		return redirect('/imovel')->withSuccess('Equipamento deletado com sucesso.');
	}

	public function criarDuas()
	{
		$unidades = Unidade::with('prumada')->get();

		foreach ($unidades as $unidade) {
			$this->verificaDuplicidade($unidade);
		}

	}

	private function verificaDuplicidade(Unidade $unidade)
	{
		if ($unidade->prumada->count() < 2) {
			$ultima = Prumada::orderByDesc('PRU_ID')->first(['PRU_ID', 'PRU_IDFUNCIONAL']);
			if (!$ultima)
				$id_funcional = 1;
			else
				$id_funcional = $ultima->PRU_IDFUNCIONAL + 1;

			$unidade->prumada()->insert([
				[
					'PRU_TIPO' => 1,
					'PRU_IDUNIDADE' => $unidade->UNI_ID,
					'PRU_NOME' => 'Área social / cozinha',
					'PRU_IDFUNCIONAL' => $id_funcional,
					'created_at' => now(),
					'updated_at' => now()
				],
				[
					'PRU_TIPO' => 1,
					'PRU_IDUNIDADE' => $unidade->UNI_ID,
					'PRU_NOME' => 'Banheiro',
					'PRU_IDFUNCIONAL' => $id_funcional + 1,
					'created_at' => now(),
					'updated_at' => now()
				]
			]);
		}
	}
}
