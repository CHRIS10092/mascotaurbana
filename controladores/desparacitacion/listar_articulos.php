<?php
require_once '../../clases/desparacitacion.php';

$obj = new desparacitacion;

$articulos = $obj->listar_articulos($_SESSION['usuario'][6]);

print_r(json_encode($articulos));
