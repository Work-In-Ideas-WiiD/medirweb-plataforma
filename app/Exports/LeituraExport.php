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

    public function array(): array
    {
        $imovel =  Imovel::find($this->imovel);

        $sheets = array(0 => array('Imovel' => $imovel->nome,), 1 => array(''), 2 => array('Nomes', 'Torre', 'Apartamentos', '# Hidrômetro',
        'Leitura Anterior M³', 'Leitura Anterior LT', 'Leitura Atual M³', 'Leitura Atual LT', 'Consumo M³', 'Valor','Data leitura Anterior', 'Data leitura Atual'),3 => array(''));

        $unidades = Imovel::find($this->imovel)->unidade;
        foreach ($unidades as $unid) {
            $prumadas = Unidade::find($unid->id)->prumada;
            foreach ($prumadas as $prumada)
            {
                $leituraAnterior = $prumada->leitura()->where('created_at', '>=', date($this->dataAnterior).' 00:00:00')->orderBy('created_at', 'asc')->first();

                $leituraAtual = $prumada->leitura()->where('created_at', '<=', date($this->dataAtual).' 23:59:59')->orderBy('created_at', 'desc')->first();

                //if(isset($leituraAnterior) && isset($leituraAtual))
                if(isset($prumada))
                {
                    $consumo = $prumada->leitura()->where('created_at', '>=', date($this->dataAnterior).' 00:00:00')->where('created_at', '<=', date($this->dataAtual).' 23:59:59')->sum('consumo');//($leituraAtual->metro ?? 0) - ($leituraAnterior->metro ?? 0);

                    // if(empty($consumo)){
                    //     $consumo = 0;
                    // }

                    // if($consumo > 10 && $consumo <= 15)
                    // {
                    //     $valor = (($consumo - 10) * 11.37) + 59;
                    // }
                    // elseif ($consumo > 15)
                    // {
                    //     $valor = (($consumo - 10) * 13.98) + 59;
                    // }
                    // else
                    // {
                    //     $valor = 59;
                    // }


                    $relatorio = array(
                        'Nomes' => $unid->nome_responsavel,
                        'Torre' => $unid->agrupamento->nome,
                        'Apartamentos' => $unid->nome,
                        '# Hidrômetro' => $prumada->funcional_id,
                        'Leitura Anterior M³' => $leituraAnterior->metro ?? 0,
                        'Leitura Anterior LT' => $leituraAnterior->litro ?? 0,
                        'Leitura Atual M³' => $leituraAtual->metro ?? 0,
                        'Leitura Atual LT' => $leituraAtual->litro ?? 0,
                        'Consumo M³' => $consumo,
                        'Valor' => 'R$ '.number_format(0, 2, ',', '.'),
                        'Data leitura Anterior' => isset($leituraAnterior->created_at) ? date('d/m/Y - H:i', strtotime($leituraAnterior->created_at)) : '',
                        'Data leitura Atual' => isset($leituraAtual->created_at) ? date('d/m/Y - H:i', strtotime($leituraAtual->created_at)) : '',
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
