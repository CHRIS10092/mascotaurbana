
<?php
session_start();
print_r($_SESSION);
print_r($_POST);
$idempresa=$_SESSION['empresa']['idempresa'];
$idsucursal=$_SESSION['sucursal']['codigo'];
print_r($idempresa);
print_r($idsucursal);
?>