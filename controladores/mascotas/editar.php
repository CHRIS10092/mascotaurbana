<?php
error_reporting(0);
require_once "../../clases/mascotas.php";

$obj    = new mascotas();
$imagen = "";
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

$datos =

    [

        $_POST['nombre'],
        $_POST['cmbsexo'],
        $_POST['fecha'],
        $_POST['color'],
        $_POST['color1'],
        $_POST['provincia'],
        $_POST['cantonu'],
        $_POST['cmb-esterelizado'],
        $imagen,
        $_POST['tenedor'],
        $_POST['codigo'],

    ];

$obj->EditarMascota($datos);

echo "1";
//print_r($datos);