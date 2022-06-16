<?php
require_once '../../clases/procesar.php';

$obj = new Procesar;

$cantones = $obj->listar_cantones($_POST['id']);

print_r(json_encode($cantones));

?>