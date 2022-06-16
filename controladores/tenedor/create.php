<?php

require_once "../../clases/tenedor.php";

$obj = new tenedor();
//obtengo el nombre de la imagen
$imagen = ($_FILES["img"]["name"]);
//nombre temporal
$nombretemp = ($_FILES["img"]["tmp_name"]);
//obtener la carpeta
$path = "../../imagenes/";
//guardar img bbdd
copy($nombretemp, $path . $imagen);
//$empresa=$_SESSION['usuario'][6];
$datos = [

    $_POST['ten-cedula'],
    $_POST['ten-nombre-p'],
    $_POST['ten-nombre-s'],
    $_POST['ten-apellido-p'],
    $_POST['ten-apellido-s'],
    $_POST['ten-fecha'],
    $_POST['ten-correo'],
    $_POST['ten-celular'],
    $_POST['provincia'],
    $_POST['canton'],
    $_POST['parroquia'],
    $_POST['ten-barrio'],
    $_POST['ten-calleprincial'],
    $_POST['ten-numerocasa'],
    $_POST['ten-callesecundaria'],
    $_POST['ten-referencia'],
    "imagenes/" . $imagen,
    $_POST['ten-session'],

];

//echo "2";
$rs = $obj->VerificarDuplicadoTenedor($_POST['ten-cedula'], $_SESSION['empresa']['idempresa']);
if (!$rs) {
    echo $obj->RegistrarTenedor($datos);
    //echo $obj->Registrar_Cliente($datos);

} else {
    echo "2";
}

//echo "ok";
//print_r($datos);