<?php 
session_start();
require_once ("../../clases/VentasModel.php");
$obj= new VentasModel();
$numero = $obj->traerCodigos($_SESSION['empresa']['idempresa'],$_SESSION['sucursal']['codigo']);
echo $numero;
?>