<?php
require_once '../../clases/exzequial.php';

$obj         = new exzequial();
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

echo $obj->insertarexzequial($datos);
//echo print_r($datos);
echo "1";
