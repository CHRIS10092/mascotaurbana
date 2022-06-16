<?php
require_once'../../clases/cliente.php';

$adchb_articulo=new cliente();

$adchb_datos=[
	
	
	$_POST['nombre'],
	$_POST['apellido'],
	$_POST['correo'],
    $_POST['celular'],
    $_POST['cedula']

];

$adchb_articulo->Editar($adchb_datos);
echo "ok";

?>