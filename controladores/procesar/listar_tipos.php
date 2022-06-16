<?php
require_once '../../clases/procesar.php';

$obj = new Procesar;

$tipos = $obj->listar_tipos();

print_r(json_encode($tipos));

?>