<?php

require_once '../../clases/empresas.php';

$adchb_usuario = new empresa();
$imagen        = "";
if ($_FILES["imagen"]["name"] == "") {
    $imagen = $_POST['Foto'];
} else {
    //obtengo el nombre de la imagen
    $foto = ($_FILES["imagen"]["name"]);
//nombre temporal
    $nombretemp = ($_FILES["imagen"]["tmp_name"]);
//obtener la carpeta
    $path = "../../imagenes/";
    unlink("../../" . $_POST['Foto']);
    $imagen = "imagenes/" . $foto;
//guardar img bbdd
    copy($nombretemp, $path . $foto);
}
$datos = [
    $_POST['rucu'],
    $_POST['empresau'],
    $_POST['correou'],
    $_POST['direccionu'],
    $_POST['telefonou'],
    $imagen,
    $_POST['tipoempresau'],
    $_POST['idu'],
];
echo $adchb_usuario->Editar($datos);
//print_r($datos);
