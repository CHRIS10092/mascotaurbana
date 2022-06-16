<?php
require_once '../../clases/exzequial.php';

$obj = new exzequial;

$articulos = $obj->listar_articulos($_SESSION['usuario'][6]);

print_r(json_encode($articulos));
