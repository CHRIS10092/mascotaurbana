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


//envio de correos admin

$body = "Reciba un saludo cordial de parte de la Empresa Mascota Urbana, la creacion de los datos de su<br>Empresa:" . $_POST['emp-nombre'] . "<br> Ruc:" . $_POST['emp-ruc'] . "<br> Direccion:" . $_POST['emp-direccion'] . "<br> celular:" . $_POST['emp-celular'] . "<br> Correo:" . $_POST['emp-correo'] . "<br> Provincia:" . $_POST['provincia'] . "<br> Canton:" . $_POST['canton']
    . "<br> Parroquia:" . $_POST['parroquia'] . "<br> Calle Principal:" . $_POST['emp-calleprincipal'] . "<br> Calle Secundaria:" . $_POST['emp-callesecundaria'] . "<br>  Numero de Oficina:" . $_POST['emp-numerooficina'] . "<br>  Referencia de Casa:" . $_POST['emp-referencia'] . "<br>  datos del Usuario:" . $_POST['usu-nombreprimer'] . "<br>  Segundo Nombre:" . $_POST['usu-segundonombre'] . "<br>  Apellido Paterno:" . $_POST['usu-apellidopaterno'] . "<br>  Apellido Materno:" . $_POST['usu-apellidomaterno'] . "<br>  Direccion:" . $_POST['usu-direccion'] . "<br>  Celular:" . $_POST['usu-celular'] . "<br>  Correo:" . $_POST['usu-correo'] . "<br>  Usuario:" . $_POST['usu-usuario'] . "<br>  Contrasenia:" . $_POST['usu-contrasenia'] . "<br>Se ha realizado de manera exitosa";

require_once 'servidor_correos/servicioCorreos.php';

function envio_empresa($tenedor, $mascota)
{

    $servicio = new ServicioCorreos;
    $sms      = "Reciba un saludo cordial de parte de la empresa mascota urbana el registro del tenedor:cedula" . $tenedor->cedula . "primer_nombre" . $tenedor->primer_nombre . "segundo_nombre" . $tenedor->segundo_nombre . "apellido_paterno" . $tenedor->apellido_paterno . "apellido_materno" . $tenedor->apellido_materno . "fecha" . $tenedor->fecha . "correo" . $tenedor->correo . "celular" . $tenedor->celular . "provincia" . $tenedor->provincia . "canton" . $tenedor->canton . "parroquia" . $tenedor->parroquia . "barrio" . $tenedor->barrio . "calle_principal" . $tenedor->calle_principal . "calle_secundaria" . $tenedor->calle_secundaria . "numero casa" . $tenedor->numero_casa . "referencia casa" . $tenedor->referencia_casa . "MASCOTA:" . "codigo" . $mascota->codigo . "nombre" . $mascota->nombre . "sexo" . $mascota->sexo . "fecha" . $mascota->fecha . "color" . $mascota->color1 . "color_secundario" . $mascota->color2 . "esterilizado" . $mascota->esterilizado . "tipo" . $mascota->tipo . "raza" . $mascota->raza . " Se ha realizado de manera exitosa";

    $servicio->enviar_email($tenedor->correo, $sms);
}

function envio_admin($tenedor, $mascota, $ok)
{

    if ($ok == '1') {
        $men = "actualizado";
    } else {
        $men = "creado";
    }

    $servicio = new ServicioCorreos;
    $sms      = "La empresa" . $_SESSION['empresa']['idempresa'] . "ha" . $men . " los siguientes datos del TENEDOR:cedula" . $tenedor->cedula . "primer_nombre" . $tenedor->primer_nombre . "segundo_nombre" . $tenedor->segundo_nombre . "apellido_paterno" . $tenedor->apellido_paterno . "apellido_materno" . $tenedor->apellido_materno . "fecha" . $tenedor->fecha . "correo" . $tenedor->correo . "celular" . $tenedor->celular . "provincia" . $tenedor->provincia . "canton" . $tenedor->canton . "parroquia" . $tenedor->parroquia . "barrio" . $tenedor->barrio . "calle_principal" . $tenedor->calle_principal . "calle_secundaria" . $tenedor->calle_secundaria . "numero casa" . $tenedor->numero_casa . "referencia casa" . $tenedor->referencia_casa . "MASCOTA:" . "codigo" . $mascota->codigo . "nombre" . $mascota->nombre . "sexo" . $mascota->sexo . "fecha" . $mascota->fecha . "color" . $mascota->color1 . "color_secundario" . $mascota->color2 . "esterilizado" . $mascota->esterilizado . "tipo" . $mascota->tipo . "raza" . $mascota->raza . " Se ha realizado de manera exitosa";

    $servicio->enviar_email("koriche001@gmail.com", $sms);
}