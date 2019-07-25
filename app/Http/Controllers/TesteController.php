<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Models\Agrupamento;


class TesteController extends Controller
{
    function index()
    {
        $f = storage_path('app/atualizado.csv');
 
        foreach (file($f) as $chave => $valor) {

            if ($chave > 3) {
               $this->tratar($valor);
            }
        }

    }

    private function tratar($info)
    {
        $info = explode(',', $info);

        if (!empty($info[0])) {
            $agrupamento = $info[0][4].$info[0][5];
    
            $array = [
                'UNI_IDAGRUPAMENTO' => $agrupamento,
                'UNI_IDIMOVEL' => $this->pegaIdImovel($agrupamento),
                'UNI_NOME' => $info[0][0].$info[0][1].$info[0][2],
                'UNI_RESPONSAVEL' => $info[1],
                'UNI_CPFRESPONSAVEL' => $info[4],
                'UNI_TELRESPONSAVEL' => $info[3]
            ];
            Unidade::updateOrCreate(
               ['UNI_IDAGRUPAMENTO' => $agrupamento, 'UNI_NOME' => $info[0][0].$info[0][1].$info[0][2]],
                $array
            );
            return $array;
        }
    }

    private function pegaIdImovel($agrupamento)
    {
        return Agrupamento::find($agrupamento)->AGR_IDIMOVEL ?? '';
    }

}