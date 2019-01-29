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
    protected $dataAnterior;
    protected $dataAtual;

    public function __construct($imovel, $dataAnterior, $dataAtual)
    {
        $this->imovel = $imovel;
        $this->dataAnterior = $dataAnterior;
        $this->dataAtual = $dataAtual;
    }

    /**
    * @return array
    */
    public function array(): array
    {
        $sheets = array();

        $unidades = Imovel::find($this->imovel)->getUnidades;
        foreach ($unidades as $unid) {
            $prumadas = Unidade::find($unid->UNI_ID)->getPrumadas;
            foreach ($prumadas as $prumada)
            {
                $leituraAnterior = $prumada->getLeituras() ->where('created_at', '>=', date($this->dataAnterior).' 00:00:00')->orderBy('created_at', 'asc')->first();

                $leituraAtual = $prumada->getLeituras() ->where('created_at', '<=', date($this->dataAtual).' 23:59:59')->orderBy('created_at', 'desc')->first();

                if(isset($leituraAnterior) && isset($leituraAtual))
                {
                    $comsumo =  $leituraAtual->LEI_METRO - $leituraAnterior->LEI_METRO;

                    if($comsumo > 10 && $comsumo <= 15)
                    {
                        $valor = (($comsumo - 10) * 11.37) + 59;
                    }
                    elseif ($comsumo > 15)
                    {
                        $valor = (($comsumo - 10) * 13.98) + 59;
                    }
                    else
                    {
                        $valor = 59;
                    }


                    $relatorio = array(
                        'Imovel' => $unid->imovel->IMO_NOME,
                        'Indice Geral' => $prumada->PRU_ID,
                        'NOMES' => $unid->UNI_RESPONSAVEL,
                        'Apartamentos' => $unid->UNI_NOME,
                        'LEITURA DEZ.2018 - ANTERIOR' => $leituraAnterior->LEI_METRO,
                        'LEITURA JAN.2019 - ATUAL' => $leituraAtual->LEI_METRO,
                        'Cosumo M³' => $comsumo,
                        'Valor' => number_format($valor, 2, ',', '.'),
                        'Data leitura DEZ.2018' => date('d/m/Y - H:i', strtotime($leituraAnterior->created_at)),
                        'Data leitura JAN.2019' => date('d/m/Y - H:i', strtotime($leituraAtual->created_at)),
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
