<?php

function prumada_status($response) {
    if (count($response) == 6)
        return $response[5];
    else
        return $response[4];        
}