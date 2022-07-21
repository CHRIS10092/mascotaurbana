
<?php
session_start();
require_once '../../clases/VentasModel';
print_r($_SESSION);
print_r($_POST);
$idempresa=$_SESSION['empresa']['idempresa'];
$idsucursal=$_SESSION['sucursal']['codigo'];
print_r($idempresa);
print_r($idsucursal);
?>