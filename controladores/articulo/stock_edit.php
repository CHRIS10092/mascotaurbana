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

    $_POST['valor'],
    $_POST['codigo'],
];

$adchb_articulo->EditarDistribucion($adchb_datos);
echo "1";
//print_r($adchb_datos);
