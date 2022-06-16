<?php

require_once '../../clases/sucursales.php';
$obj   = new sucursal();
$datos = [

    $_POST['sucu-numerou'],
    $_POST['sucu-nombreu'],
    $_POST['sucu-direccionu'],
    $_POST['sucu-telefonou'],
    $_POST['sucu-numestu'],
    $_POST['sucu-numfacu'],
    $_POST['sucu-estadou'],
    $_POST['emp-tipoempresau'],

];

//echo $obj->ActualizarSucursal($datos);
print_r($datos);
//echo "1";
