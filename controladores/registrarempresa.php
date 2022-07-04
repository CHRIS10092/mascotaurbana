<?php

require_once '../clases/empresas.php';
$obj = new empresa();

//crear carpeta de ruc

function crear_directorio($nombreCarpeta)
{

    if (!file_exists($nombreCarpeta)) {
        mkdir($nombreCarpeta, 0777, true);
    }
}

//crear carpetas para nueva empresa
function asignar_directorios($ruc)
{

    $directorioRaiz = "../archivos/";
    //crear carpeta principal para cada empresa = numero de ruc
    $directorioPrincipal = $directorioRaiz . $ruc;
    crear_directorio($directorioPrincipal);

    //crear carpeta logo de empresa
    $directorioLogo = $directorioPrincipal . "/logo";
    crear_directorio($directorioLogo);
    //crear carpeta firma de empresa
    $directorioFirma = $directorioPrincipal . "/firma";
    crear_directorio($directorioFirma);
    //crear carpeta imagenes articulos de empresa
    $directorioArticulos = $directorioPrincipal . "/articulos";
    crear_directorio($directorioArticulos);

    //retornar todos los directorias creados
    $directorios = [
        "directorioLogo"  => $directorioLogo,
        "directorioFirma" => $directorioFirma,

    ];
    return $directorios;
}
//asignar directorios a la empresa
$directorios = asignar_directorios($_POST["emp-ruc"]);

//recojer datos de los archivos logo y firma electronica
$archivoLogo = [
    "descripArchivo" => $_FILES['img']['name'],
    "rutaArchivo"    => $_FILES['img']['tmp_name'],
];

$archivoFirma = [
    "descripArchivo" => $_FILES['ruta-firma']['name'],
    "rutaArchivo"    => $_FILES['ruta-firma']['tmp_name'],
];
// guardar los archivos y obtener la ruta del directorio correspondiente
$pathLogo  = guardar_archivo($archivoLogo, $directorios["directorioLogo"]);
$pathFirma = guardar_archivo($archivoFirma, $directorios["directorioFirma"]);

//guardar archivo
function guardar_archivo($archivo, $directorio)
{

    $pathArchivo = $directorio . "/" . $archivo["descripArchivo"];
    copy($archivo["rutaArchivo"], $pathArchivo);
    return $pathArchivo;
}


//traer los datos para verificar los post
//$hash  = password_hash($_POST['usu-contrasenia'], PASSWORD_DEFAULT);
$datos = [
    $_POST['emp-id'],
    $_POST['emp-ruc'],
    $_POST['emp-nombre'],
    $_POST['emp-direccion'],
    $_POST['emp-correo'],
    $_POST['emp-celular'],
    $pathLogo,
    $_POST['provincia'],
    $_POST['canton'],
    $_POST['parroquia'],
    $_POST['emp-calleprincipal'],
    $_POST['emp-callesecundaria'],
    $_POST['emp-numerooficina'],
    $_POST['emp-referencia'],
    $_POST['emp-estado'],
    $_POST['emp-tipoempresa'],
    //datos usuario de empresa

    $_POST['usu-nombreprimer'],
    $_POST['usu-segundonombre'],
    $_POST['usu-apellidopaterno'],
    $_POST['usu-apellidomaterno'],
    $_POST['usu-direccion'],
    $_POST['usu-celular'],
    $_POST['usu-correo'],
    $_POST['usu-usuario'],
    $_POST['usu-contrasenia'],
    //certificado
    $pathFirma,
    $_POST['contrasena-firma'],
    $_POST['tipoambiente'],

];

$rs = $obj->VerificarDuplicadoRuc($_POST['emp-ruc']);
$id = $obj->VerificarId($_POST['emp-id']);
if ($rs) {
    echo "ya existe una empresa con ese ruc";
} else if ($id) {
    echo "ya existe  el id ";
} else {
    $regisemp     = $obj->Registrar($datos);
    $registrarusu = $obj->Registrar_Usuario($datos);

    // print_r($datos);
}


