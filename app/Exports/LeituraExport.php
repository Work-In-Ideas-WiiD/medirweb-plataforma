<?php

namespace App\Exports;

use App\Models\Imovel;
use App\Models\Unidade;
use App\Models\Leitura;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;

class LeituraExport implements FromArray
{

    use Exportable;

    protected $imovel;

    public function __construct(int $imovel)
    {
        $this->imovel = $imovel;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        //$sheets = [];

        $sheets = array();

        $unidades = Imovel::find($this->imovel)->getUnidades;
        foreach ($unidades as $unid) {
            $prumadas = Unidade::find($unid->UNI_ID)->getPrumadas;
            foreach ($prumadas as $prumada)
            {
                $leituraAnterior = $prumada->getLeituras() ->where('created_at', '<=', date('2018-12-21').' 23:59:00')->orderBy('created_at', 'desc')->first();

                $leituraAtual = $prumada->getLeituras() ->where('created_at', '>=', date('2019-01-21').' 00:00:00')->orderBy('created_at', 'desc')->first();

                if(isset($leituraAnterior) && isset($leituraAtual))
                {
                    $comsumo =  $leituraAtual->LEI_METRO - $leituraAnterior->LEI_METRO;

                    $relatorio = array(
                        'Imovel' => $unid->IMO_NOME,
                        'Unidade' => $unid->UNI_NOME,
                        'LEITURA DEZ.2018 - ANTERIOR' => $leituraAnterior->LEI_METRO,
                        'LEITURA JAN.2019 - ATUAL' => $leituraAtual->LEI_METRO,
                        'Cosumo M³' => $comsumo,
                        'Data última leitura' => date('d/m/Y - H:i', strtotime($leituraAtual->created_at)),
                    );

                    array_push($sheets, $relatorio);
                }
            }
        }

        return $sheets;
    }

//    /**
//    * @return \Illuminate\Support\Collection
//    */
//    public function collection()
//    {
////        Leitura::find(10930)->prumada()->unidade()->where('UNI_IDIMOVEL', 1)->get();
////
////        $listas = array();
////
////        $unidades = Imovel::find(1)->getUnidades;
////        foreach ($unidades as $unid) {
////            $prumadas = Unidade::find($unid->UNI_ID)->getPrumadas;
////            foreach ($prumadas as $prumada)
////            {
////                $leitura = $prumada->getLeituras()->orderBy('created_at', 'asc')->first();
////
////                $relatorio = array(
////                    'Condomínio Residencial Maranata',
////                    $unid->UNI_NOME,
////                    $leitura->LEI_METRO,
////                    $leitura->LEI_LITRO,
////                    $leitura->LEI_MILILITRO,
////                    date('d/m/Y - H:i', strtotime($leitura->created_at)),
////                );
////
////                array_push($listas, $relatorio);
////
////            }
////        }
//
//        //var_dump((object) $listas); die();
//        return Leitura::byLeituraexport(1);
//    }
}
