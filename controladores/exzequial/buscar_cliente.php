<?php

require_once '../../clases/vacu.php';

$obj = new vacu;

$respuesta = $obj->buscar_cliente($_POST['rucci'], $_SESSION['usuario'][6]);

print_r(json_encode($respuesta));
