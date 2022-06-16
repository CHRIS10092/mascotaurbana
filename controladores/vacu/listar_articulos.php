<?php
require_once '../../clases/vacu.php';

$obj = new vacu;

$articulos = $obj->listar_articulos($_SESSION['usuario'][6]);

print_r(json_encode($articulos));
