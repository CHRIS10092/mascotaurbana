<?php 
require_once'../../clases/categoria.php';

$adchb_categoria=new categoria();

$adchb_datos=[
	$_POST['detalle']
];
echo $adchb_categoria->Registrar($adchb_datos);

 ?>