<?php
require_once '../../clases/articulo.php';

$adchb_articulo = new articulo();
$imagen         = "";
if ($_FILES["foto-actual"]["name"] == "") {
    $imagen = $_POST['foto'];
} else {
    //obtengo el nombre de la imagen
    $foto = ($_FILES["foto-actual"]["name"]);
//nombre temporal
    $nombretemp = ($_FILES["foto-actual"]["tmp_name"]);
//obtener la carpeta
    $path = "../../imagenes/";
    unlink("../../" . $_POST['foto']);
    $imagen = "imagenes/" . $foto;
//guardar img bbdd
    copy($nombretemp, $path . $foto);
}

$adchb_datos = [

    $_POST['codigo'],
    $_POST['nombre'],
    $_POST['descrip'],
    $_POST['stock'],
    $_POST['valor'],
    $_POST['valorpvp'],
    $imagen,
    $_POST['categoria'],
    $_POST['subcategoria'],
    $_POST['session'],
    $_POST['id'],
];

$adchb_articulo->Editar($adchb_datos);
echo 1;
//print_r($adchb_datos);
