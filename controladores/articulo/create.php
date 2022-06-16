<?php

require_once '../../clases/articulo.php';

$adchb_articulo = new articulo();

//obtengo el nombre de la imagen
$imagen = ($_FILES["img"]["name"]);
//nombre temporal
$nombretemp = ($_FILES["img"]["tmp_name"]);
//obtener la carpeta
$path = "../../imagenes/";
//guardar img bbdd
copy($nombretemp, $path . $imagen);

$adchb_datos = [

    $_POST['codigo'],
    $_POST['nombre'],
    $_POST['descripcion'],
    $_POST['stock'],
    $_POST['valor'],
    $_POST['valorpvp'],
    "imagenes/" . $imagen,
    $_POST['categoria'],
    $_POST['subcategoria'],
    $_POST['expiracion'],
    $_POST['session'],
    $_POST['lote'],
    $_POST['sucursal'],

];

if ($_POST['session'] == 00001) {
    echo $adchb_articulo->Registrar($adchb_datos);
    //print_r($adchb_datos);
} else {
    echo $adchb_articulo->RegistrarEmpresa($adchb_datos);
    //print_r($adchb_datos);
}

?>