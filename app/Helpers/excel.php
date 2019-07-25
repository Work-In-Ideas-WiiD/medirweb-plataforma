<?php

function csvToArray($path) {
    $csv= file_get_contents(storage_path('app/'.$path.'.csv'));
    return array_map("str_getcsv", explode(";", $csv));
}