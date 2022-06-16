<?php
require_once '../../clases/vacu.php';

$obj         = new vacu();
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

echo $obj->insertar($datos);
//echo print_r($datos);
echo "1";
