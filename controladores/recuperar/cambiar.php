<?php 
require_once '../../clases/correos.php';
$obj = new Correos;
session_start();
$res = false;
$mensaje = "ERROR AL CAMBIAR LA CLAVE";
$id = $_SESSION['iduser'];
$clave = $_POST['clave'];

if($obj->modificar_clave($id,$clave)){
	$res = true;
	$mensaje = "La Clave Ha Sido Cambiada Correctamente";
}

$respuesta = [

	"res" => $res,
	"mensaje" => $mensaje
];
print_r(json_encode($respuesta))

?>