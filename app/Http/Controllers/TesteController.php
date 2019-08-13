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
use App\Models\Fatura;
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
                'id' => $cliente->CLI_ID,
                'tipo' => $cliente->CLI_TIPO,
                'foto' => $cliente->CLI_FOTO ?? '',
                'documento' => $cliente->CLI_DOCUMENTO,
                'nome_juridico' => $cliente->CLI_NOMEJUR,
                'nome_fantasia' => $cliente->CLI_NOMEFAN ?? '',
                'data_nascimento' => $cliente->CLI_DATANASC,
                'status' => $cliente->CLI_STATUS,
                'created_at' => $cliente->created_at,
                'updated_at' => $cliente->updated_at
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

            //migrar o endereco
            foreach (DB::connection('banco_antigo')->table('imoveis')
                ->where('IMO_IDCLIENTE', $cliente->CLI_ID)->get() as $imovel) {
                
                //migrar endereco do imovel
                $imove = Endereco::firstOrCreate([
                    'logradouro' => $imovel->IMO_LOGRADOURO,
                    'complemento' => $imovel->IMO_COMPLEMENTO,
                    'numero' => $imovel->IMO_NUMERO,
                    'bairro' => $imovel->IMO_BAIRRO,
                    'cidade_id' => $imovel->IMO_IDCIDADE,
                    'cep' => $imovel->IMO_CEP,
                ])->imovel()->firstOrCreate([//migrar imovel
                    'cliente_id' => $imovel->IMO_IDCLIENTE,
                    'foto' => $imovel->IMO_FOTO ?? '',
                    'capa' => $imovel->IMO_CAPA ?? '',
                    'cnpj' => $imovel->IMO_CNPJ,
                    'nome' => $imovel->IMO_NOME,
                    'status' => $imovel->IMO_STATUS,
                    'fatura_ciclo' => $imovel->IMO_FATURACICLO,
                    'taxa_fixa' => $imovel->IMO_TAXAFIXA,
                    'taxa_variavel' => $imovel->IMO_TAXAVARIAVEL,
                    'ip' => $imovel->IMO_IP,
                    'created_at' => $imovel->created_at,
                    'updated_at' => $imovel->updated_at
                ]);
                //cadastro de telefone de imovel
                if (strstr($imovel->IMO_TELEFONES, '<br/>')) {
                    foreach (explode('<br/>', $imovel->IMO_TELEFONES) as $telefone_imovel) {
                        if ($telefone_imovel) {
                            //migrar telefone do imovel
                            $imove->telefone()->firstOrCreate([
                                'numero' => $telefone_imovel,
                                'etiqueta' => 'pessoal'
                            ]);
                        }
                    }
                } else {
                    foreach (explode("\r\n", $imovel->IMO_TELEFONES) as $telefone_imovel) {
                        if ($telefone_imovel) {
                            //migrar telefone do imovel
                            $imove->telefone()->firstOrCreate([
                                'numero' => $telefone_imovel,
                                'etiqueta' => 'pessoal'
                            ]);
                        }
                    }
                }

                 //cadastro de responsavel de imovel
                 if (strstr($imovel->IMO_RESPONSAVEIS, '<br/>')) {
                    foreach (explode('<br/>', $imovel->IMO_RESPONSAVEIS) as $responsavel_imovel) {
                        if ($responsavel_imovel) {
                            //migrar responsavel do imovel
                            $imove->responsavel()->firstOrCreate([
                                'nome' => $responsavel_imovel,
                                'descricao' => 'não informado'
                            ]);
                        }
                    }
                } else {
                    foreach (explode("\r\n", $imovel->IMO_RESPONSAVEIS) as $responsavel_imovel) {
                        if ($responsavel_imovel) {
                            //migrar responsavel do imovel
                            $imove->responsavel()->firstOrCreate([
                                'nome' => $responsavel_imovel,
                                'descricao' => 'não informado'
                            ]);
                        }
                    }
                }

                
            }
        }
        
        foreach (DB::connection('banco_antigo')->table('agrupamentos')->get() as $agrupamento) {
            
            Agrupamento::updateOrCreate([
                'id' => $agrupamento->AGR_ID,
                'imovel_id' => $agrupamento->AGR_IDIMOVEL,
                'nome' => $agrupamento->AGR_NOME,
                'created_at' => $agrupamento->created_at,
                'updated_at' => $agrupamento->updated_at
            ]);
            
        }

        //migra faturas
        foreach (DB::connection('banco_antigo')->table('faturas')->get() as $fatura) {
            Fatura::firstOrCreate([
                'id' => $fatura->FAT_ID,
                'imovel_id' => $fatura->FAT_IMOID,
                'data_leitura_fornecedor' => $fatura->FAT_DTLEIFORNECEDOR,
                'metro_fornecedor' => $fatura->FAT_LEIMETRO_FORNECEDOR,
                'metro_valor_fornecedor' => floatval($fatura->FAT_LEIMETRO_VALORFORNECEDOR),
                'metro_unidade' => $fatura->FAT_LEIMETRO_UNI,
                'consumo_imovel' => $fatura->FAT_CONSUMO_IMOVEL,
                'consumo_valor_imovel' => floatval($fatura->FAT_CONSUMO_VALORIMOVEL),
                'consumo_unidade' => $fatura->FAT_CONSUMO_UNI,
                'consumo_valor_unidade' => floatval($fatura->FAT_CONSUMO_VALORUNI),
                'consumo_fornecedor' => $fatura->FAT_CONSUMO_FORNECEDOR,
                'created_at' => $fatura->created_at,
                'updated_at' => $fatura->updated_at
            ]);
        }


        foreach (DB::connection('banco_antigo')->table('faturas_unidades')->get() as $fatura_unidade) {
            
        }


    }

}