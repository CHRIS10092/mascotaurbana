<?php
require_once '../../clases/procesar.php';

$obj = new Procesar;

$parroquias = $obj->listar_parroquias($_POST['id']);

print_r(json_encode($parroquias));

?>