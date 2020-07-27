<?php

function leitura_nova_para_decimal($leitura) {
    $hex = bin2hex(base64_decode($leitura));

    return [
        'hex' => $hex,
        'versao_firmware' => hexdec(substr($hex, 0, 2)),
        'bateria' => hexdec(substr($hex, 2, 2)),
        'relogio_01' => hexdec(substr($hex, 4, 8)),
        'relogio_02' => hexdec(substr($hex, 14, 8)),
        'relogio_03' => hexdec(substr($hex, 24, 8)),
        'relogio_04' => hexdec(substr($hex, 32, 8)),
    ];
}
