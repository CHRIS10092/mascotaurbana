<?php
require_once '../../clases/procesar.php';

$obj = new Procesar;

$articulos = $obj->listar_articulos($_SESSION['empresa']['idempresa']);

print_r(json_encode($articulos));
