<?php
require_once '../../clases/vacunas.php';
$obj   = new vacunas();
$datos = [
    $_POST['codigou'],
    $_POST['descripcionu'],
    $_POST['tipovacunau'],
];

echo $obj->editar($datos);
//print_r($datos);
