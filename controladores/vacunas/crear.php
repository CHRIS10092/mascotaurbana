<?php
require_once '../../clases/vacunas.php';
$obj   = new vacunas();
$datos = [
    $_POST['descripcion'],
    $_POST['tipovacuna'],
];

echo $obj->insertar($datos);
//print_r($datos);
