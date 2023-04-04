<?php
function redondeado($numero)
{
    $entero = floor($numero);
    $decimal = $numero - $entero;
    if ($decimal > 0) {
        $decimal = explode(".", $decimal)[1];
        if (strlen($decimal) > 2) {
            $decimal = ($decimal[0] . $decimal[1]) + 1;
        }
    }
    return floatval($entero . "." . $decimal);
}
