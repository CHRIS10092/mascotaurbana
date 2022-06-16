<?php
require_once '../../clases/seguros.php';

$obj         = new seguros();
$descripcion = "";
$tipo        = "";
$datos       = [
    $_POST['fecha'],
    //$_POST['fecha-fin'],
    $_POST['listado'],
    $_POST['codigomas'],
    $descripcion,
    $tipo,

];

echo $obj->insertarSeguro($datos);
//echo print_r($datos);
echo "1";
