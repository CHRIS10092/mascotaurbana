<?php 
require_once'../../clases/usuario.php';

$adchb_usuario=new usuario();

$adchb_datos=[
	$_POST['nombreu'],
	$_POST['usuario'],
	$_POST['correou'],
	$_POST['direccionu'],
	$_POST['celularu'],
	$_POST['perfilu'],

	$_POST['idu']
];
echo $adchb_usuario->Editar($adchb_datos);

 ?>