<?php
require_once '../servidor_correos/servicioCorreos.php';
$obj = new ServicioCorreos;

$res = false;
$mensaje = "";
$cuenta_correo = $_POST['correo'];

if($obj->verificar_correo($cuenta_correo)){

	if($obj->enviar_correo($cuenta_correo)){
		$mensaje = "La Cuenta de Correo para Acceder a Recuperar Clave";
		$res = true;
	}else{
		$mensaje = "del envio de correo";

	}

}else{

	$mensaje = "La Cuenta de Correo No Existe";
}



$respuesta = [

	"res" => $res,
	"mensaje" => $mensaje

];

print_r(json_encode($respuesta));
?>