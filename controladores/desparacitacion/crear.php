<?php
require_once '../../clases/desparacitacion.php';

$obj         = new desparacitacion();
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

echo $obj->insertarDesparacitacion($datos);
//echo print_r($datos);
echo "1";
