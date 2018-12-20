<?php

namespace App\Exports;

use App\Models\Imovel;
use App\Models\Unidade;
use App\Models\Leitura;
use Maatwebsite\Excel\Concerns\FromCollection;

class LeituraExport implements FromCollection
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
//        Leitura::find(10930)->prumada()->unidade()->where('UNI_IDIMOVEL', 1)->get();
//
//        $listas = array();
//
//        $unidades = Imovel::find(1)->getUnidades;
//        foreach ($unidades as $unid) {
//            $prumadas = Unidade::find($unid->UNI_ID)->getPrumadas;
//            foreach ($prumadas as $prumada)
//            {
//                $leitura = $prumada->getLeituras()->orderBy('created_at', 'asc')->first();
//
//                $relatorio = array(
//                    'Condomínio Residencial Maranata',
//                    $unid->UNI_NOME,
//                    $leitura->LEI_METRO,
//                    $leitura->LEI_LITRO,
//                    $leitura->LEI_MILILITRO,
//                    date('d/m/Y - H:i', strtotime($leitura->created_at)),
//                );
//
//                array_push($listas, $relatorio);
//
//            }
//        }

        //var_dump((object) $listas); die();
        return Leitura::byLeituraexport(1);
    }
}
