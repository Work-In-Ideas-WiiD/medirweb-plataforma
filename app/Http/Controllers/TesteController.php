<?php

namespace App\Http\Controllers;

use App\Models\Imovel;
use App\Models\Unidade;
use App\Models\Agrupamento;
use Illuminate\Http\Request;
use App\Traits\UploadFile;

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
        return $this->cropImage(request()->img, 'upload/app/');
        
    }

}