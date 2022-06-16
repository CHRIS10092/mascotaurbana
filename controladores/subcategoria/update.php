<?php 
require_once'../../clases/subcategoria.php';

$adchb_subcategoria=new subcategoria();

$adchb_datos=[
	$_POST['detalle'],
	$_POST['categoria'],
	$_POST['id']
];
echo $adchb_subcategoria->Editar($adchb_datos);
