<?php
require_once '../../clases/seguros.php';
require_once '../../helpers/funciones.php';
$obj = new seguros;

$numero = $obj->obtener_numero_venta($_SESSION['usuario'][6]);
$secuencia->secuenciales($numero, 9);

print_r(json_encode($_SESSION['usuario'][15] . "-" . $_SESSION['usuario'][16] . "-" . $secuencia));
