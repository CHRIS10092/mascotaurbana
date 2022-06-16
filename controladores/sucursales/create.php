<?php

require_once '../../clases/sucursales.php';
$obj   = new sucursal();
$datos = [

    $_POST['numero'],
    $_POST['sucu-nombre'],
    $_POST['sucu-direccion'],
    $_POST['sucu-telefono'],
    $_POST['sucu-numest'],
    $_POST['sucu-numfac'],
    $_POST['sucu-estado'],
    $_POST['emp-tipoempresa'],

];

echo $obj->InsertarSucursal($datos);
//print_r($datos);
echo "1";
