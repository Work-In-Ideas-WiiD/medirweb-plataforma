<?php

namespace App\Http\Controllers;

use DB;
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
	private $debug = null;

	private $raspberry_url = 'http://localhost:8081';

	public function create()
	{
		$imoveis = Imovel::get(['nome', 'id']);

		$agrupamentos = $imoveis[0]->agrupamento->pluck('nome', 'id');

		$imoveis = $imoveis->pluck('nome', 'id');

		return view('prumada.create', compact('agrupamentos', 'imoveis'));
	}

	public function store(PrumadaSaveRequest $data)
	{
		$prumada = Prumada::create($data->except('imovel_id', 'agrupamento_id'));

		// Adicionar prumada no central raspberry
		$dadosCentral['EQP_IDUNI'] = $prumada->unidade_id;
		$dadosCentral['EQP_IDPRU'] = $prumada->id;
		$dadosCentral['EQP_IDFUNCIONAL'] = $prumada->funcional_id;

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

		Timeline::create([
			"prumada_id" => $prumada->id,
			"user" => auth()->user()->name,
			"descricao" => "criou novo equipamento #".$prumada->id,
			"icone" => "fa fa-plus bg-green"
		]);

		// Sem comunicação com a central do imovel
		if(!$resposta)
			return back()->withError('Sem comunicação com a central do imovel! Tente novamente mais tarde no ATUALIZAR EQUIPAMENTO, para atualizar a base de dados!');

		return back()->withSuccess('Equipamento cadastrada com sucesso.');
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

			if ($data->status == '0') {
				$antigo = 'Ativo';
				$novo = 'Inativo';
				$icone = "fa fa-close bg-red";
			} else {
				$antigo = 'Inativo';
				$novo = "Ativo";
				$icone = "fa fa-check bg-green";
			}
			
			$prumada->criarTimeline('STATUS', $antigo, $novo, $icone);
		}

		if ($data->serial != $prumada->serial) // TIMELINE - Nº de SERIAL
			$prumada->criarTimeline('NÚMERO DE SERIAL', $prumada->serial, $data->serial, 'pencil bg-yellow');

		if ($data->funcional_id != $prumada->funcional_id) // TIMELINE - ID FUNCIONAL
			$prumada->criarTimeline('ID FUNCIONAL', $prumada->funcional_id, $data->funcional_id, 'pencil bg-yellow');
		
		if ($data->fabricante != $prumada->fabricante) // TIMELINE - FABRICANTE
			$prumada->criarTimeline('FABRICANTE', $prumada->fabricante, $data->fabricante, 'pencil bg-yellow');
		
		if ($data->modelo != $prumada->PRU_MODELO) // TIMELINE - MODELO
			$prumada->criarTimeline('MODELO', $prumada->modelo, $data->modelo, 'pencil bg-yellow');

		if ($data->operadora != $prumada->operadora) // TIMELINE - OPERADORA
			$prumada->criarTimeline('OPERADORA', $prumada->operadora, $data->operadora, 'pencil bg-yellow');

		if ($data->nome != $prumada->nome) // TIMELINE - NOME
			$prumada->criarTimeline('NOME', $prumada->nome, $data->nome, 'pencil bg-yellow');

		// PRUMADA - ATUALIZAR
		$prumada->update($data->all());



		// PRUCURANDO prumada na central raspberry para pegar o id da prumada da central
		$chPruCentral = curl_init();
		curl_setopt($chPruCentral, CURLOPT_RETURNTRANSFER, 1);
		if ($this->debug)
			curl_setopt($chPruCentral, CURLOPT_URL, "{$this->raspberry_url}/equipamentos/");
		else
			curl_setopt($chPruCentral, CURLOPT_URL, "http://{$prumada->unidade->imovel->ip}/equipamentos/");

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
			if($pruCentral['EQP_IDPRU'] == $prumada->id)
				$idPruCentral = $pruCentral['id'];

		}
		// fim

		if (!empty($idPruCentral)) {
			// Atualizar prumada no central raspberry
			$dadosCentral['EQP_IDUNI'] = $prumada->unidade_id;
			$dadosCentral['EQP_IDPRU'] = $prumada->id;
			$dadosCentral['EQP_IDFUNCIONAL'] = $prumada->funcional_id;

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
		}

		return back()->withSuccess('Equipamento atualizado com sucesso.');
	}

	public function destroy(Request $request, Prumada $prumada)
	{
		$prumada->timeline()->create([
			'user' => auth()->user()->name,
			'descricao' => "deletou equipamento #".$prumada->id,
			'icone' => "fa fa-trash bg-red"
		]);
	
		$prumada->delete();

		return back()->withSuccess('Equipamento deletado com sucesso.');
	}

	public function criarDuas()
	{
		$unidades = Unidade::with('prumada')->get();

		foreach ($unidades as $unidade)
			$this->verificaDuplicidade($unidade);

	}

	private function verificaDuplicidade(Unidade $unidade)
	{
		if ($unidade->prumada->count() < 2) {
			$ultima = Prumada::orderByDesc('PRU_ID')->first(['id', 'funcional_id']);
			if (!$ultima)
				$id_funcional = 1;
			else
				$id_funcional = $ultima->funcional_id + 1;

			$unidade->prumada()->insert([
				[
					'tipo' => 1,
					'unidade_id' => $unidade->UNI_ID,
					'nome' => 'Área social / cozinha',
					'funcional_id' => $id_funcional,
					'created_at' => now(),
					'updated_at' => now()
				],
				[
					'tipo' => 1,
					'unidade_id' => $unidade->UNI_ID,
					'nome' => 'Banheiro',
					'funcional_id' => $id_funcional + 1,
					'created_at' => now(),
					'updated_at' => now()
				]
			]);
		}
	}
}
