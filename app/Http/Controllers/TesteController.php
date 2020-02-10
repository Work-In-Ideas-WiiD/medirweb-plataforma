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
use App\User;
use App\Models\Fatura;
use App\Models\FaturaUnidade;
use App\Models\Prumada;
use App\Models\Leitura;
use App\Models\Timeline;
use Carbon\Carbon;


class TesteController extends Controller
{
    use UploadFile;

    function uploadCsv()
    {
        $imoveis = Imovel::pluck('nome', 'id');
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
                'agrupamento_id' => $agrupamento->id,
                'imovel_id' => $imovel,
                'nome' => $info[0][0].$info[0][1].$info[0][2],
                'nome_responsavel' => $info[1],
                'cpf_responsavel' => $info[4],
            ];

            Unidade::updateOrCreate(
                [
                   'agrupamento_id' => $agrupamento->id,
                   'nome' => $info[0][0].$info[0][1].$info[0][2]
                ],
                $array
            )->telefone()->updateOrCreate([
                'etiqueta' => 'responsável',
                'numero' => $info[3]
            ]);

            return $array;
        }
    }

    private function criarAgrupamento($nome, $imovel_id)
    {
        return Agrupamento::updateOrCreate([
            'imovel_id' => $imovel_id,
            'nome' => $nome
        ]);
    }

    function teste()
    {   
        $data = now()->format('Y-m-d');
        dd($data);

        $resut = Carbon::parse(strtotime($data))->month;
        dd( $resut);

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

        
        
        //aqui migramos as prumadas
        foreach (DB::connection('banco_antigo')->table('unidades')->get() as $unidade) {
            Unidade::firstOrCreate([
                'id' => $unidade->UNI_ID,
                'agrupamento_id' => $unidade->UNI_IDAGRUPAMENTO,
                'imovel_id' => $unidade->UNI_IDIMOVEL,
                'nome' => $unidade->UNI_NOME,
                'nome_responsavel' => $unidade->UNI_RESPONSAVEL,
                'cpf_responsavel' => $unidade->UNI_CPFRESPONSAVEL,
                'created_at' => $unidade->created_at,
                'updated_at' => $unidade->updated_at
            ])->telefone()->firstOrCreate([
                'etiqueta' => 'responsavel',
                'numero' => $unidade->UNI_TELRESPONSAVEL
            ]);
        }
        
        
        //aqui migramos os users
        foreach (DB::connection('banco_antigo')->table('users')->get() as $user) {
            User::firstOrCreate([
                'id' => $user->id,
                'imovel_id' => ($user->USER_IMOID !== 0) ? $user->USER_IMOID : null,
                'unidade_id' => ($user->USER_UNIID !== 0) ? $user->USER_UNIID : null,
                'foto' => $user->foto,
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'remember_token' => $user->remember_token,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at
            ]);
        }


        //aqui migramos as prumadas
        foreach (DB::connection('banco_antigo')->table('prumadas')->get() as $prumada) {
            Prumada::firstOrCreate([
                'id' => $prumada->PRU_ID,
                'unidade_id' => $prumada->PRU_IDUNIDADE,
                'tipo' => $prumada->PRU_TIPO,
                'nome' => $prumada->PRU_NOME,
                'funcional_id' => $prumada->PRU_IDFUNCIONAL,
                'serial' => $prumada->PRU_SERIAL,
                'fabricante' => $prumada->PRU_FABRICANTE,
                'modelo' => $prumada->PRU_MODELO,
                'operadora' => $prumada->PRU_OPERADORA,
                'status' => $prumada->PRU_STATUS,
                'created_at' => $prumada->created_at,
                'updated_at' => $prumada->updated_at
            ]);
        }
            
            
        //aqui migramos as faturas de unidades
        foreach (DB::connection('banco_antigo')->table('faturas_unidades')->get() as $fatura_unidade) {

            $faturas_unidade_nova = json_decode('['.$fatura_unidade->FATUNI_PRUMADAS.']');

            foreach ($faturas_unidade_nova as $fatura_unidade_nova) {

                FaturaUnidade::firstOrCreate([
                    'unidade_id' => $fatura_unidade->FATUNI_IDUNI,
                    'fatura_id' => $fatura_unidade->FATUNI_IDFATURA,
                    'prumada_id' => $fatura_unidade_nova->PRU_ID,
                    'prumada_valor' => floatval($fatura_unidade_nova->PRU_VALOR),
                    'prumada_consumo' => $fatura_unidade_nova->PRU_CONSUMO,
                    'prumada_leitura_anterior' => $fatura_unidade_nova->PRU_LEIANTERIOR,
                    'prumada_data_leitura_anterior' => $fatura_unidade_nova->PRU_DTLEIANTERIOR,
                    'prumada_leitura_atual' => $fatura_unidade_nova->PRU_LEIATUAL,
                    'prumada_data_leitura_atual' => $fatura_unidade_nova->PRU_DTLEIATUAL,
                ]);


            }

        }


        foreach (DB::connection('banco_antigo')->table('timelines')->get() as $timeline) {
            Timeline::firstOrCreate([
                'id' => $timeline->TIMELINE_ID,
                'prumada_id' => $timeline->TIMELINE_IDPRUMADA,
                'user' => $timeline->TIMELINE_USER,
                'descricao' => $timeline->TIMELINE_DESCRICAO,
                'icone' => $timeline->TIMELINE_ICON,
                'created_at' => $timeline->created_at,
                'updated_at' => $timeline->updated_at
            ]);
        }


        foreach (DB::connection('banco_antigo')->table('leituras')->get() as $leitura) {
            Leitura::firstOrCreate([
                'id' => $leitura->LEI_ID,
                'prumada_id' => $leitura->LEI_IDPRUMADA,
                'metro' => $leitura->LEI_METRO,
                'litro' => $leitura->LEI_LITRO,
                'mililitro' => $leitura->LEI_MILILITRO,
                'valor' => $leitura->LEI_VALOR,
                'created_at' => $leitura->created_at,
                'updated_at' => $leitura->updated_at
            ]);
        }


        $roles = DB::connection('banco_antigo')->table('roles')->get();

        foreach ($roles as $role)
            DB::table('roles')->insert((array) $role);



        $roles_user = DB::connection('banco_antigo')->table('role_user')->get();

        foreach ($roles_user as $role_user)
            DB::table('role_user')->insert((array) $role_user);


    }


    public function felicittaAtualizarEquipamentos()
    {
        $file = storage_path('app/csv/lista_atualizada_hidrometros.csv');
        
        $csv = file_get_contents($file);

        $title = false;

        foreach (file($file) as $line)
            if ($title)
                $this->felicittaAtualizarEquipamentos2($line);
            else
                $title = true;

    }

    public function felicittaAtualizarEquipamentos2($line)
    {
        $line = str_replace("\r", "", $line);
        $line = str_replace("\n", "", $line);
        $line = explode(';', $line);
        $line = array_map(function($string) {
            return str_replace('"', '', $string);
        }, $line);

        //imovel_id ==  15

        $agrupamento = Agrupamento::where(function($query) use ($line) {
            $query->where('imovel_id', 15)->where(DB::raw("abs(nome)"), abs($line[1]));
        })->orWhere(function($query) use ($line) {
            $query->where('imovel_id', 15)->where('nome', "Bloco 0{$line[1]}");
        })->first();


        if ($agrupamento) {
            $unidade = Unidade::with('prumada')->where('agrupamento_id', $agrupamento->id)->where('nome', $line[2])->first();
            if ($unidade) {
                $this->felicittaAtualizarEquipamentos3($agrupamento, $unidade, $line);
            } else {
                file_put_contents(storage_path('app/csv/erros_felicitta.json'), json_encode($line).',', FILE_APPEND);
            }
        } else {
            file_put_contents(storage_path('app/csv/erros_felicitta.json'), json_encode($line).',', FILE_APPEND);
        }
    }

    public function exportJson()
    {
        $file = storage_path('app/csv/lista_hidrometros_repetidor_novo_atualizacao.json');

        $arquivo = file_get_contents($file);
                
        // Decodifica o formato JSON e retorna um Objeto
        $json = json_decode($arquivo); 

        // dd($json);

        foreach($json as $registro):
            
            $agrupamento = Agrupamento::where(function($query) use ($registro) {
                $query->where('imovel_id', 15)->where(DB::raw("abs(nome)"), abs($registro->BLC));
            })->orWhere(function($query) use ($registro) {
                $query->where('imovel_id', 15)->where('nome', "Bloco 0{$registro->BLC}");
            })->first();

            if ($agrupamento) {
                $unidade = Unidade::with('prumada')->where('agrupamento_id', $agrupamento->id)->where('nome', $registro->Ap)->first();
                if ($unidade) {
                    $this->felicittaAtualizarEquipamentos3($agrupamento, $unidade, $registro);
                } else {
                    file_put_contents(storage_path('app/csv/erros_felicitta.json'), json_encode($registro, true).',', FILE_APPEND);
                }
            } else {
                file_put_contents(storage_path('app/csv/erros_felicitta.json'), json_encode($registro, true).',', FILE_APPEND);
            }

         
        endforeach;

        // dd($json);
        echo 'Export success!';

    }

    public function felicittaAtualizarEquipamentos3($agrupamento, $unidade, $registro)
    {
        // DB::beginTransaction();

        if($registro->Local == 'A. Serv.'){
            $nome = 'Área social / cozinha';
        }
        elseif($registro->Local == 'Banho'){
            $nome = 'Banheiro';
        }

        $prumada1 = Prumada::updateOrCreate([
            'unidade_id' => $unidade->id,
            'nome' => $nome
        ], [
            'tipo' => 1,
            'unidade_id' => $unidade->id,
            'nome' => $nome,
            'funcional_id' => $registro->ID_equip,
            'repetidor_id' => $registro->Rep_ativo,
        ]);

    //    $unidade->update([
    //         'repetidor_id' => $registro->Rep_ativo
    //     ]);

    //     if ($unidade->repetidor_id != $registro->Rep_ativo) {
    //         DB::statement("UPDATE unidades SET repetidor_id = {$registro->Rep_ativo} where id = {$unidade->id}");
    //     }
        // // return $teste;
        // if($unidade->id == 443)
        // {
        //     dd($unidade, $registro, $teste);
        // }

        // $prumada2 = Prumada::updateOrCreate([
        //     'unidade_id' => $unidade->id,
        //     'nome' => 'Banheiro'
        // ], [
        //     'tipo' => 1,
        //     'unidade_id' => $unidade->id,
        //     'nome' => 'Banheiro',
        //     'funcional_id' => $line[7]
        // ]);

        // $login = $this->felicittaCriarLogins($unidade->imovel_id, $agrupamento->nome, $unidade);

        // if ($prumada1) {
        //     DB::commit();
        //     return true;
        // }

        // dd($registro);

        // DB::rollback();
    }


    public function felicittaCriarLogins($imovel_id, $bloco, $unidade)
    {
        $emailbloco = str_replace(' ', '', $bloco);

        $user = User::firstOrCreate([
            'unidade_id' => $unidade->id,
            'imovel_id' => $unidade->imovel_id,
            'name' => "{$bloco} {$unidade->nome}"
        ], [
            'unidade_id' => $unidade->id,
            'imovel_id' => $unidade->imovel_id,
            'name' => "{$bloco} {$unidade->nome}",
            'email' => "{$emailbloco}{$unidade->nome}@medirweb.com.br",
            'password' => bcrypt($bloco.$unidade)
        ]);

        $user->roles()->attach([4]);

        return $user;
    
    }

    public function felicittaLogins()
    {
        $users = User::where('imovel_id', 15)->get();

        foreach($users as $user)
        {
            if($user->id != 33)
            {
                $senha = str_replace(' ', '', $user->name);

                // dd($senha);
    
                $user->update(['password' => bcrypt('medirweb'.$senha) ]);
            }
        }

        echo 'finalizou senhas';
    }


    public function teste_relatorio()
    {
        $prumada = Prumada::find(1428);
        
        $data = Carbon::parse('2020-01-01');

        $horas = [8, 12, 15, 20, 0];


        $result = $prumada->leitura_ciclica($data, $horas, ['id', 'litro', 'metro']);

        dd(
            $result,
            $result[12]->litro //exemplo de consulta de litro da hora 8
        );
    }


    public function relatorio_fatura_unidade()
    {
        $json = storage_path('app/json/leitura_administradora_atualizado.json');

        $json = json_decode(file_get_contents($json));

        foreach ($json as $info) {
            $agrupamento = Agrupamento::where('imovel_id', 15)->where(DB::raw('abs(nome)'), $info->bloco)->first();

            if ($agrupamento) {
                $unidade = $agrupamento->unidade()->with('prumada')->where('nome', $info->unidade)->first();

                $prumada = $unidade->prumada[0];


                FaturaUnidade::firstOrCreate([
                    'unidade_id' => $unidade->id,
                    'fatura_id' => 11,
                    'prumada_valor' => ($info->leitura_atual - $info->leitura_anterior) * 10,
                    'prumada_id' => $prumada->id,
                    'prumada_consumo' => $info->leitura_atual - $info->leitura_anterior,
                    'prumada_leitura_anterior' => $info->leitura_anterior,
                    'prumada_leitura_atual' => $info->leitura_atual,
                    'prumada_data_leitura_anterior' => '2019-11-30',
                    'prumada_data_leitura_atual' => '2019-12-31',
                ]);
            }      
        }

        return 'faturas unidades criadas';
    }

    public function felicitta_moradores()
    {
        $file = storage_path('app/csv/qtd_moradores_17012020.csv');
        $file = file_get_contents($file);

        foreach(explode("\n", $file) as $line) {
            $line = explode(',', $line);

            if (!empty($line[1])) {
                $agrupamento = Agrupamento::where('imovel_id', 15)->where('nome', $line[1])->first();
                
                $unidade = $agrupamento->unidade()->where('nome', $line[0])->first();

                if($line[2] == '')
                    $line[2] = NULL;
                else
                    $line[2] = intval($line[2]);

                if ($unidade)
                    $unidade->update(['quantidade_moradores' => $line[2]]);
            }

        }
    }


    public function felicitta_corrigir_repetidor()
    {
        $array = 0;
        
        $repetidores = [
            4078 => [194, 147, 150],
            4079 => [406, 203, 195, 234],
            4080 => [192, 281, 232, 115],
            4081 => [353, 60, 56, 169, 163],
            4084 => [264, 347, 371]
        ];
    }


    public function felicitta_equipamentos()
    {
        $equipamentos = [];

        $blocos = [
            '01' => [],
            '02' => [],
            '03' => [],
            '04' => [],
            '05' => [],
            '06' => [],
            '07' => [],
            '08' => [],
            '09' => [],
            '10' => [],
            '11' => [],
            '12' => []
        ];

        $unidades = Unidade::where('imovel_id', 15)->get();

        foreach ($unidades as $unidade) {
            $prumadas = $unidade->prumada()->with('unidade.agrupamento')->orderBy('nome')->get();

            foreach ($prumadas as $prumada) {

                if (!isset($equipamentos[$prumada->repetidor_id])) {
                    $equipamentos[$prumada->repetidor_id] = $blocos;
                }

                foreach ($equipamentos[$prumada->repetidor_id] as $bloco => $key) {
                    if (($prumada->unidade->agrupamento->nome ?? null) == $bloco) {
                        array_push($equipamentos[$prumada->repetidor_id][$bloco], $prumada->funcional_id);
                    }
                }

            }

        }

        return $equipamentos;
    }
}