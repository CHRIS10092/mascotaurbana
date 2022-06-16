<?php

session_start();
error_reporting(0);
require_once "../../clases/mascotas.php";
$obj = new mascotas();

//obtengo el nombre de la imagen
$imagen = ($_FILES["img"]["name"]);
//nombre temporal
$nombretemp = ($_FILES["img"]["tmp_name"]);
//obtener la carpeta
$path = "../../imagenes/";
//guardar img bbdd
copy($nombretemp, $path . $imagen);
$dir      = "codigosQr/";
$codigoqr = ($dir . $_POST['codigo'] . ".png");

$datos = [

    $_POST['codigo'],
    $_POST['nombre'],
    $_POST['cmbsexo'],
    $_POST['fecha'],
    $_POST['color'],
    $_POST['color1'],
    $_POST['provincia'],
    $_POST['canton'],
    $_POST['cmb-esterilizado'],
    "imagenes/" . $imagen,
    $_POST['tenedor'],
    $codigoqr,
    $_POST['session'],
];
//echo ("registro exitoso");

$rs = $obj->VerificarDuplicadoMascota($_POST['codigo']);
if (!$rs) {

    echo $obj->registrarmascota($datos);

    crear_qr($datos);
} else {
    echo "el numero de cedula de la mascota ya existe";
}

function crear_qr($datos)
{

    require_once "../../app/contenido/librerias/phpqrcode/qrlib.php";

    $dir       = "../../codigosQr/";
    $filename  = $dir . $datos[0] . ".png";
    $tam       = "1";
    $level     = "L";
    $frameSize = 1;
    $contenido = "\n\t Codigo: " . $datos[0] .
        "\n\t Nombre Mascota: " . $datos[1] .
        "\n\t Sexo: " . $datos[2] .
        "\n\t Raza: " . $datos[3] .
        "\n\t Tipo Mascota: " . $datos[4] .
        "\n\t Esterelizado: " . $datos[5] .
        "\n\t Imagen: " . $datos[9] .

        "\n\t Primer Nombre: " . $datos[10] .

        "\n\t Calle Secundaria: " . $datos[2];

    Qrcode::png($contenido, $filename, $level, $tam, $frameSize);
}

header("../../app/mascotas.php");

//print_r($datos);
