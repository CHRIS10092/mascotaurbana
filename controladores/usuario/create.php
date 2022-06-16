<?php 
require_once'../../clases/usuario.php';

$adchb_usuario=new usuario();

$adchb_datos=[
	$_POST['nombre'],
	$_POST['usuario'],
	$_POST['correo'],
	$_POST['direccion'],
	$_POST['celular'],
	$_POST['perfil']
];
echo $adchb_usuario->Registrar($adchb_datos);

 ?>