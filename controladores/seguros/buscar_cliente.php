<?php

require_once '../../clases/seguros.php';

$obj = new seguros;

$respuesta = $obj->buscar_cliente($_POST['rucci'], $_SESSION['usuario'][6]);

print_r(json_encode($respuesta));
