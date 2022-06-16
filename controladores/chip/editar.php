<?php 
require_once "../../clases/chips.php";

$obj= new chips();
$datos=[
    $_POST['id'],
    $_POST['codigo'],
    $_POST['cmbchip'],
    $_SESSION['empresa']['codigo'],
    $_SESSION['sucursal']['idsucursal']

];
print_r($datos);
//echo $pbj->Editar($datos);



?>