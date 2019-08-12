<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Imovel;
use App\Models\Unidade;
use App\Models\Agrupamento;
use Illuminate\Http\Request;
use App\Traits\UploadFile;
use DB;
use App\Models\Pais;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Endereco;

class TesteController extends Controller
{
    use UploadFile;

    function uploadCsv()
    {
        $imoveis = Imovel::pluck('IMO_NOME', 'IMO_ID');
        return view('timeline.importar_unidades_csv', compact('imoveis'));
    }

    function process(Request $data)
    {
        $csv = md5(time()).'.csv';
        $data->csv->storeAs('csv/', $csv);
        $f = storage_path('app/csv/'.$csv);

 
        foreach (file($f) as $chave => $valor) {

            if ($chave > 0) {
               $this->tratar($valor, $data->imovel);
            }

        }

        return back()->withSuccess('Unidades atualizadas com sucesso!');

    }

    private function tratar($info, $imovel)
    {
        $info = explode(',', $info);

        if (!empty($info[0])) {
            $agrupamento = $this->criarAgrupamento($info[0][4].$info[0][5], $imovel);
    
            $array = [
                'UNI_IDAGRUPAMENTO' => $agrupamento->AGR_ID,
                'UNI_IDIMOVEL' => $imovel,
                'UNI_NOME' => $info[0][0].$info[0][1].$info[0][2],
                'UNI_RESPONSAVEL' => $info[1],
                'UNI_CPFRESPONSAVEL' => $info[4],
                'UNI_TELRESPONSAVEL' => $info[3]
            ];

            Unidade::updateOrCreate(
                [
                   'UNI_IDAGRUPAMENTO' => $agrupamento->AGR_ID,
                   'UNI_NOME' => $info[0][0].$info[0][1].$info[0][2]
                ],
                $array
            );

            return $array;
        }
    }

    private function criarAgrupamento($nome, $imovel_id)
    {
        return Agrupamento::updateOrCreate([
            'AGR_IDIMOVEL' => $imovel_id,
            'AGR_NOME' => $nome
        ]);
    }

    function teste()
    {
        //Migrar Pais
        Pais::firstOrCreate([
            'nome' => 'Brasil',
            'codigo' => 'BR'
        ]);

        //migrar estados
        foreach (DB::connection('banco_antigo')->table('estados')->get() as $estado) {
            Estado::firstOrCreate([
                'id' => $estado->EST_ID,
                'nome' => $estado->EST_NOME,
                'codigo'=> $estado->EST_ABREVIACAO
            ]);
            //migrar cidades
            foreach (DB::connection('banco_antigo')->table('cidades')
                ->where('CID_IDESTADO',$estado->EST_ID)->get() as $cidade){
                
                    Cidade::firstOrCreate([
                        'id'=> $cidade->CID_ID,
                        'estado_id'=> $cidade->CID_IDESTADO,
                        'nome' => $cidade->CID_NOME
                    ]);
            }
        }



        //migrando o cliente
        $clientes = DB::connection('banco_antigo')->table('clientes')->get();

        foreach ($clientes as $cliente) {

            //aqui migramos o endereco dos clientes
            $client = Endereco::firstOrCreate([
                'logradouro' => $cliente->CLI_LOGRADOURO,
                'complemento' => $cliente->CLI_COMPLEMENTO,
                'bairro' => $cliente->CLI_BAIRRO,
                'cidade_id' => $cliente->CLI_CIDADE,
                'numero' => $cliente->CLI_NUMERO,
                'cep' => $cliente->CLI_CEP
            ])->cliente()->firstOrCreate([ //migrar cliente
                'tipo' => $cliente->CLI_TIPO,
                'foto' => $cliente->CLI_FOTO ?? '',
                'documento' => $cliente->CLI_DOCUMENTO,
                'nome_juridico' => $cliente->CLI_NOMEJUR,
                'nome_fantasia' => $cliente->CLI_NOMEFAN ?? '',
                'data_nascimento' => $cliente->CLI_DATANASC,
                'status' => $cliente->CLI_STATUS
            ]);

            foreach (explode('<br/>', $cliente->CLI_DADOSCONTATO) as $telefone) {
                if ($telefone) {
                    //migrar telefone do cliente
                    $client->telefone()->firstOrCreate([
                        'numero' => $telefone,
                        'etiqueta' => 'pessoal'
                    ]);
                }
            }
        }


    }

}