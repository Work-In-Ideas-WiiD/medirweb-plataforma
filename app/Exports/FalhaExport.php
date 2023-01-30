<?php

namespace App\Exports;

use App\Models\Imovel;
use App\Models\Falha;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;

class FalhaExport  implements FromArray
{

    use Exportable;

    protected $imovel;
    protected $falhas;

    public function __construct($imovel, $falhas)
    {
        $this->imovel = $imovel;
        $this->falhas = $falhas;
    }

    public function array(): array
    {
        $imovel =  Imovel::find($this->imovel);

        $sheets = array(0 => array('Imovel' => $imovel->nome,), 1 => array(''), 2 => array('EQP', 'Nome EQP', 'Imóvel',
        'Nome Responsável', 'Torre', 'Apartemento', 'ID Funcional', 'Status', 'Repetidor', 'Data'),3 => array(''));

        foreach ($this->falhas as $falha) {
        
                    $relatorio = array(
                        'EQP' => $falha->id,
                        'Nome EQP' => $falha->prumada->nome,
                        'Imóvel' => $falha->prumada->unidade->imovel->nome,
                        'Nome Responsável' => $falha->prumada->unidade->nome_responsavel,
                        'Torre' => $falha->prumada->unidade->agrupamento->nome,
                        'Apartemento' => $falha->prumada->unidade->nome,
                        'ID Funcional' => $falha->prumada->funcional_id,
                        'Status' => $falha->status,
                        'Repetidor' => $falha->repetidor ?? 'Inexistente',
                        'Data' => date('d/m/Y', strtotime($falha->created_at)),
                    );

                    array_push($sheets, $relatorio);
        }
        

        return $sheets;
    }


}
