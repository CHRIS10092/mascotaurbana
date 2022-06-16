<?php
require_once '../../clases/procesar.php';

$obj = new Procesar;

$razas = $obj->listar_razas($_POST["id"]);

print_r(json_encode($razas));

?>