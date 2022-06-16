<?php

//session_start();
require_once "../../clases/tenedor.php";

$obj    = new tenedor();
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

        $_POST['nombre-pu'],
        $_POST['nombre-su'],
        $_POST['apellido-pu'],
        $_POST['apellido-su'],
        $_POST['fechau'],
        $_POST['correou'],
        $_POST['celularu'],
        $_POST['provinciau'],
        $_POST['cantonu'],
        $_POST['parroquiau'],
        $_POST['barriou'],
        $_POST['calleprincialu'],
        $_POST['numerocasau'],
        $_POST['callesecundariau'],
        $_POST['referenciau'],
        $imagen,
        $_POST['sessionu'],
        $_POST['cedulau'],

    ];
//echo 1;
if ($_POST['sessionu'] == 00001) {
    echo $obj->EditarTenedor($datos);
} else {
    echo $obj->EditarTenedor($datos);
}
//print_r($datos);