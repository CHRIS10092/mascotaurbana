<?php
require_once '../../clases/seguros.php';

$obj = new seguros;

$articulos = $obj->listar_articulos($_SESSION['usuario'][6]);

print_r(json_encode($articulos));
