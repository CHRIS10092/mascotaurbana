<?php
require_once '../../clases/procesar.php';
require_once '../../helpers/funciones.php';
//print_r($_SESSION['usuario'][11]);
$obj = new Procesar;

$numero = $obj->obtener_numero_venta($_SESSION['empresa']['idempresa']);

$secuencia = secuenciales($numero, 9);
//print_r($secuencia);
print_r(json_encode($secuencia));
