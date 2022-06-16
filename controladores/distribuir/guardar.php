<?php
require_once ("../../clases/distribuir.php");
$obj= new distribuir();

$datos= [$_GET['articulo'],$_GET['subzona'],$_GET['cantidad']];



if($obj->insertardistri($datos)){

	$articulo = $obj->stock_articulo($_GET['articulo']);
	$cantidad_nueva = $articulo->stock - $_GET['cantidad'];
	$obj->actualizar_stock($_GET['articulo'],$cantidad_nueva);

	echo 'datos guardados correctamente';
}


?>