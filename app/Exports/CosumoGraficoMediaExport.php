<?php

namespace App\Exports;

use App\Models\Imovel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Events\AfterSheet;

class CosumoGraficoMediaExport implements FromArray
{
    use Exportable;

    private $mes = [
        1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
        5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
        9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
    ];

    protected $imovel;
    protected $consumo;

    public function __construct($imovel, $consumo)
    {
        $this->imovel = $imovel;
        $this->consumo = $consumo;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE)->setFitToHeight(1000, true)->setFitToWidth(1000, true);
            },
        ];
    }
    
    public function array(): array
    {
        $mes = $this->mes;
        
        $imovel =  Imovel::find($this->imovel);

        $sheets = array(0 => array('Imovel' => $imovel->nome,), 1 => array(''), 
        2 => array('Tipo', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'), 
        3 => array(''));

        array_unshift($this->consumo["bloco"], 'Bloco');
        array_unshift($this->consumo["total"], 'Média');

        array_push($sheets, $this->consumo);
                        
        return $sheets;
    }
}
