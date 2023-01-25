<?php

namespace App\Exports;

use App\Models\Imovel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;

class CosumoExport implements FromArray
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
        $mes = $this->mes;

        if($this->meses == 6)
            $array_titulo = array($this->nome, $mes[now()->subMonth(5)->month], $mes[now()->subMonth(4)->month], $mes[now()->subMonth(3)->month], $mes[now()->subMonth(2)->month], $mes[now()->subMonth(1)->month], $mes[now()->subMonth(0)->month]);
        else
            $array_titulo = array($this->nome, 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
        
        $imovel =  Imovel::find($this->imovel);

        $sheets = array(0 => array('Imovel' => $imovel->nome,), 1 => array(''), 2 => $array_titulo, 3 => array(''));

        foreach ($this->consumo as $bloco => $cons)
        {
            $relatorio = array(
                'Bloco' => $bloco,
            );

            foreach ($cons as $mes => $cosumo)
            {
                $relatorio[$mes] = $cosumo;
            }

            array_push($sheets, $relatorio);
        }
                

        return $sheets;
    }
}
