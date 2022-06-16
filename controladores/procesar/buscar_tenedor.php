<?php
require_once '../../clases/procesar.php';

$obj = new Procesar;

$respuesta = $obj->buscar_tenedor($_POST['cedula'], $_SESSION['empresa']['tiposervicio']);

print_r(json_encode($respuesta));
