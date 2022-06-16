<?php 
require_once'../../clases/categoria.php';

$adchb_categoria=new categoria();

$adchb_datos=[
	$_POST['detalle'],
	$_POST['id']
];

echo $adchb_categoria->Editar($adchb_datos);

 ?>