<?php

namespace App\Exports;

use App\Models\Unidade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class UnidadeExport implements WithEvents, FromCollection, WithHeadings, WithColumnFormatting, WithMapping
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function map($invoice): array
    {
        return [
            $invoice->imovel->nome,
            $invoice->agrupamento->nome,
            $invoice->nome,
            $invoice->nome_responsavel,
            $invoice->cpf_responsavel,
            $this->devices( $invoice->prumada )
        ];
    }

    public function columnFormats(): array
    {
        return [
            
        ];
    }
   
    private function devices($prumadas)
    {
        $devices = '';

        foreach($prumadas as $prumada)
        {
            $devices .= $prumada->nome.' ('.$prumada->funcional_id.') ';
        }
        
        return $devices;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE)->setFitToHeight(1000, true)->setFitToWidth(1000, true);
            },
        ];
    }

    public function headings(): array
    {
        return [
            'Imovel',
            'Torre/Agrupamento',
            'Unidade',
            'Nome Responsavel', 
            'Cpf Responsavel', 
            'Devices TX', 
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $order = ($this->request->order) ? $this->request->order : 'desc';

        return Unidade::orderBy('id', $order)
            ->where('imovel_id', $this->request->imovel_id)
            ->get();
    }

}
