<?php
require_once("../../clases/mascotas.php");
$obj = new mascotas;
$res = false;
$mensaje = "";
$numero = $_POST["numero"];
$tenedor = $_POST["tenedor"];
$idtenedor = $_POST["idtenedor"];
$articulo = null;
$cantidad = null;

if($obj->encontrar_numero_venta($numero)){

	if($obj->verificar_tenedor_venta($numero ,$idtenedor) == 0){

		if($obj->verificar_numero_venta($numero) == 0){
			$res = true;

			$articulo = $obj->mostrar_detalle($numero);
			$mascotas = $obj->verificar_mascota_registrada($idtenedor);

			$cantidad = $articulo->cantidad - $mascotas->cantidad;
	    }else{
	    	$mensaje = "El Numero de Venta No Esta Asociado Al Tenedor";
	    }
	}else if($obj->verificar_tenedor_venta($numero ,$idtenedor) > 0 ){
		$res = true;

		$articulo = $obj->mostrar_detalle($numero);
		$mascotas = $obj->verificar_mascota_registrada($idtenedor);

		$cantidad = $articulo->cantidad - $mascotas->cantidad;
	}
	
}else{

	$mensaje = "EL Numero de Venta No Existe";
}

$respuesta = [
"res" => $res,
"mensaje" => $mensaje,
"articulo" => $articulo,
"cantidad" => $cantidad
 
];

print_r(json_encode($respuesta));


?>