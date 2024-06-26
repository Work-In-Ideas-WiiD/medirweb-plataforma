<?php

namespace App\Exports;

use App\Models\Imovel;
use App\Models\Unidade;
use App\Models\Leitura;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Carbon\Carbon;

use DatePeriod;
use DateTime;
use DateInterval;

class LeituraAdminExport implements FromArray
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
        // $datas = new DatePeriod(new DateTime($this->dataAnterior), new DateInterval('P1D'), date_modify( new DateTime($this->dataAtual), '+1 day'));

        // $datas_relatorio = array(' ', ' ', ' ', ' ');

        // foreach($datas as $data) {
        //     array_push($datas_relatorio, $data->format('d/m/Y'));
        // }

        $imovel =  Imovel::find($this->imovel);

        $sheets = array( 0 => array('unidade', 'bloco', 'mes', 'ano', 'consumo', 'leitura'));

        $unidades = Imovel::find($this->imovel)->unidade;
        foreach ($unidades as $unid) {
            $prumadas = Unidade::find($unid->id)->prumada;
            $leitura_total = 0;
            foreach ($prumadas as $prumada)
            {
                $leitura_total += $prumada->leitura()->whereDate('created_at', '<=', Carbon::parse(strtotime($this->dataAtual))->format('Y-m-d'))->orderBy('created_at', 'desc')->first()->metro ?? 0;      
            }

            $relatorio = array(
                'unidade' => intval($unid->nome),
                'bloco' => intval($unid->agrupamento->nome),
                'mes' => Carbon::parse(strtotime($this->dataAtual))->month,
                'ano' => Carbon::parse(strtotime($this->dataAtual))->year,
                'consumo' => 2,
                'leitura' => $leitura_total,
            );

            // foreach($datas as $data) {

            //     $relatorio[$data->format('d/m/Y')] = $prumada->leitura()->whereDate('created_at', $data->format('Y-m-d'))->orderBy('created_at', 'desc')->first()->metro ?? ' ';       
            // }

            array_push($sheets, $relatorio);
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
