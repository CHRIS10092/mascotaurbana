<?php

require_once '../../clases/procesar.php';

$obj = new Procesar;

$respuesta = $obj->buscar_cliente($_POST['rucci']);

print_r(json_encode($respuesta));
