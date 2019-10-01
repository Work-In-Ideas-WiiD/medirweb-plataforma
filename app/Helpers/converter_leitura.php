<?php

function converter_leitura($funcional, $hex, $hex_original) {
    if ($hex) {
        $hex = json_decode($hex);

        if (count($hex) > 15)
            return leitura_nova($funcional, $hex, $hex_original);
        
        return leitura_antiga($funcional, $hex, $hex_original);
    }

    return (object) [
        'funcional' => $funcional,
        'hexadecimal' => 'nenhuma informação',
        'm3' => 'N/A',
        'litros' => 'N/A',
        'decilitros' => 'N/A',
        'valor' => 'N/A',
    ];
}

function leitura_antiga($funcional, $hex, $hex_original) {
    return (object) [
        'funcional' => $funcional,
        'hexadecimal' => $hex_original,
        'm3' => hexdec($hex['5'].$hex['6']),
        'litros' => hexdec($hex['9'].$hex['10']),
        'decilitros' => hexdec($hex['13'].$hex['14']),
        'valor' => ((hexdec($hex['5'].$hex['6']) * 1000) + hexdec($hex['9'].$hex['10'])).hexdec($hex['13'].$hex['14'])
    ];
}

function leitura_nova($funcional, $hex, $hex_original) {
    return (object) [
        'funcional' => $funcional,
        'hexadecimal' => $hex_original,
        'm3' => hexdec($hex['5'].$hex['6'].$hex['7']),
        'litros' => hexdec($hex['10'].$hex['11']),
        'decilitros' => hexdec($jsons['15']),
        'valor' => ((hexdec($hex['5'].$hex['6'].$hex['7']) * 1000) + hexdec($hex['10'].$hex['11'])).hexdec($jsons['15'])
    ];
}