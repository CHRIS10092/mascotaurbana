<?php 
require_once '../../clases/chips.php';

$obj= new chips();
$datos=[
    $_POST['codigo'],
    $_POST['cmbchip'],
    $_SESSION['empresa']['idempresa'],
    $_SESSION['sucursal']['codigo']

];
//print_r($datos);
echo $obj->Registrar($datos);



?>