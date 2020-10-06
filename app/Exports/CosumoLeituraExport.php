<?php

namespace App\Exports;

use App\Models\Imovel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;

class CosumoLeituraExport implements FromArray
{
    use Exportable;

    protected $imovel;
    protected $consumo;

    public function __construct($imovel, $consumo, $nome, $meses)
    {
        $this->imovel = $imovel;
        $this->consumo = $consumo;
        $this->nome = $nome;
        $this->meses = $meses;
    }

    public function array(): array
    {
       
        $lista = [ 
            0 => 'Data e Hora',
            1 => 'Leitura Acumulada',
            2 => 'Consumo Acumulado'
        ];

        $imovel =  Imovel::find($this->imovel);

        $sheets = array(0 => array('Imovel' => $imovel->nome,), 1 => array(''), 2 => $lista, 3 => array(''));

        foreach ($this->consumo as $unidade => $cons)
        {
            $relatorio = array(
                'Data e Hora' => $cons->created_at,
                'Leitura Acumulada' => $cons->metro,
                'Consumo Acumulado' => $cons->consumo,
            );

            array_push($sheets, $relatorio);
        }
                
        return $sheets;
    }
}
