<?php 
require_once'../../clases/subcategoria.php';

$adchb_subcategoria=new subcategoria();

$adchb_datos=[
	$_POST['detalle'],
	$_POST['categoria'],
];
echo $adchb_subcategoria->Registrar($adchb_datos);

 ?>