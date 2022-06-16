<?php
//
function secuenciales($str, $num)
{
    $num_cadena = strlen($str);
    if ($num_cadena == $num) {
        $acum_ceros = "";
        $cont_sec   = strlen($str + 1);
        $num_ceros  = $num - $cont_sec;
        for ($i = 0; $i < $num_ceros; $i++) {
            $acum_ceros .= "0";
        }

        return $acum_ceros . ($str + 1);
    } else {
        return 0;
    }

}
