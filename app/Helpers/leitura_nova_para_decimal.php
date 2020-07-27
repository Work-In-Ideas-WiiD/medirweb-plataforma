<?php

function leitura_nova_para_decimal($leitura) {
    $hex = bin2hex(base64_decode($leitura));

    return [
        'hex' => $hex,
        'versao_firmware' => substr($hex, 0, 2),
        'bateria' => substr($hex, 2, 2),
        'relogio_01' => substr($hex, 4, 8),
        'relogio_02' => substr($hex, 14, 8),
        'relogio_03' => substr($hex, 24, 8),
        'relogio_04' => substr($hex, 32, 8),
    ];
}
