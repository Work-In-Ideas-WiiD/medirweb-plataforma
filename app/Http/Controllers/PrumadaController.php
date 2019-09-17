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
		$unidades = $prumada->unidade->pluck('nome', 'id');
	
		$agrupamentos = $prumada->unidade->imovel->pluck('nome', 'id');

		$imoveis = $prumada->unidade->imovel->pluck('nome', 'id');

		return view('prumada.edit', compact( 'imoveis', 'unidades', 'agrupamentos', 'prumada'));
	}

	public function update(PrumadaEditRequest $data, Prumada $prumada)
	{
		$logado = auth()->user()->name;

		// TIMELINE - STATUS
		if ($data->status != $prumada->status){

			$statusAntigo = $prumada->status == 0 ? 'Inativo' : 'Ativo';

			if ($data->status == '0') {
				$statusNovo = 'Inativo';
				$TIMELINE_ICON1 = "fa fa-close bg-red";
			} else {
				$statusNovo = "Ativo";
				$TIMELINE_ICON1 = "fa fa-check bg-green";
			}

			$TIMELINE_DESCRICAO1 = "atualizou o 'STATUS' do equipamento #{$prumada->id} de '<a>{$statusAntigo}</a>' para '<a>{$statusNovo}</a>'";

			$timelineData1 = [
				"prumada_id" => $prumada->id,
				"user" => $logado,
				"descricao" => $TIMELINE_DESCRICAO1,
				"icone" => $TIMELINE_ICON1
			];
			Timeline::create($timelineData1);
		}

		// TIMELINE - Nº de SERIAL
		if ($data->serial != $prumada->serial) {

			$timelineData2 = [
				"prumada_id" => $prumada->id,
				"user" => $logado,
				"descricao" => "atualizou o 'NÚMERO DE SERIAL' do equipamento #{$prumada->id} de '<a>{$prumada->serial}</a>' para '<a>{$data->serial}</a>'",
				"icone" => "fa fa-pencil bg-yellow"
			];
			Timeline::create($timelineData2);
		}

		// TIMELINE - ID FUNCIONAL
		if ($data->funcional_id != $prumada->funcional_id) {

			$timelineData3 = [
				"prumada_id" => $prumada->id,
				"user" => $logado,
				"descricao" => "atualizou o 'ID FUNCIONAL' do equipamento #{$prumada->id} de '<a>{$prumada->funcional_id}</a>' para '<a>{$data->funcional_id}</a>'",
				"icone" => "fa fa-pencil bg-yellow"
			];
			Timeline::create($timelineData3);
		}

		// TIMELINE - FABRICANTE
		if ($data->fabricante != $prumada->fabricante) {

			$timelineData4 = [
				"prumada_id" => $prumada->id,
				"user" => $logado,
				"descricao" => "atualizou o 'FABRICANTE' do equipamento #{$prumada->id} de '<a>{$prumada->fabricante}</a>' para '<a>{$data->fabricante}</a>'",
				"icone" => "fa fa-pencil bg-yellow"
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
		//criar uma funcao para reutilizar todos esses codigos no lugar de ficar criando um a um

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
