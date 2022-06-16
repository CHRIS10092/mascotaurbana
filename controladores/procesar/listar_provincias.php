<?php
require_once '../../clases/procesar.php';

$obj = new Procesar;

$provincias = $obj->listar_provincias();

print_r(json_encode($provincias));

?>