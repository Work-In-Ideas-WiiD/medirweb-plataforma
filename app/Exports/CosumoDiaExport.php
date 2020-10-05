<?php

namespace App\Exports;

use App\Models\Imovel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;

class CosumoDiaExport implements FromArray
{
    use Exportable;

    private $mes = [
        1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
        5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
        9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
    ];

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
        $dia = $this->consumo["dias"];
        $dia2 = [ 0 => ''];
        $dias = array_merge($dia2, $this->consumo["dias"]);

        $imovel =  Imovel::find($this->imovel);

        $sheets = array(0 => array('Imovel' => $imovel->nome,), 1 => array(''), 2 => $dias, 3 => array(''));

        foreach ($this->consumo["consumo"] as $unidade => $cons)
        {
            $relatorio = array(
                'Unidade' => $unidade,
            );

            foreach ($cons as $dia => $cosumo)
            {
                $relatorio[$dia] = $cosumo;
            }

            array_push($sheets, $relatorio);
        }
                
        return $sheets;
    }
}
