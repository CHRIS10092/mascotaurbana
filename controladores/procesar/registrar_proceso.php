<?php

require_once '../../clases/procesar.php';
$obj = new Procesar;
require_once '../servidor_correos/servicioCorreos.php';
$res     = false;
$mensaje = "";

$proceso          = json_decode($_POST['proceso']);
$proceso_tenedor  = $proceso->tenedor;
$proceso_mascotas = $proceso->mascota;

$ok = 0;

$tenedor = [
    "cedula"           => $proceso_tenedor->cedula,
    "primer_nombre"    => $proceso_tenedor->primer_nombre,
    "segundo_nombre"   => $proceso_tenedor->segundo_nombre,
    "apellido_paterno" => $proceso_tenedor->apellido_paterno,
    "apellido_materno" => $proceso_tenedor->apellido_materno,
    "fecha"            => $proceso_tenedor->fecha,
    "correo"           => $proceso_tenedor->correo,
    "celular"          => $proceso_tenedor->celular,
    "provincia"        => $proceso_tenedor->provincia,
    "canton"           => $proceso_tenedor->canton,
    "parroquia"        => $proceso_tenedor->parroquia,
    "barrio"           => $proceso_tenedor->barrio,
    "calle_principal"  => $proceso_tenedor->calle_principal,
    "calle_secundaria" => $proceso_tenedor->calle_secundaria,
    "numero"           => $proceso_tenedor->numero_casa,
    "referencia"       => $proceso_tenedor->referencia_casa,
    "foto"             => "imagenes/" . $_FILES["imagen-tenedor"]["name"],
    "empresa"          => $_SESSION['empresa']['idempresa'],
];

if ($obj->verificar_mascota($proceso_mascotas->codigo)) {
    $res     = true;
    $mensaje = "Codigo de Mascotas ya Existe";
}

if (!$res) {

    if ($obj->verificar_tenedor($proceso_tenedor->cedula, $_SESSION['empresa']['idempresa'])) {
        $obj->actualizar_tenedor($tenedor);
        $ok = 1;
    } else {
        $obj->registrar_tenedor($tenedor);

        $imagen = ($_FILES["imagen-tenedor"]["name"]);
        //nombre temporal
        $nombretemp = ($_FILES["imagen-tenedor"]["tmp_name"]);
        //obtener la carpeta
        $path = "../../imagenes/";
        //guardar img bbdd
        copy($nombretemp, $path . $imagen);
        $ok = 2;
    }

    $imagen_mas = ($_FILES["imagen-mascota"]["name"]);
    //nombre temporal
    $nombre_mas_temp = ($_FILES["imagen-mascota"]["tmp_name"]);
    //obtener la carpeta
    $path_mas = "../../imagenes/";
    //guardar img bbdd
    copy($nombre_mas_temp, $path_mas . $imagen_mas);

    $mascota = [
        "codigo"           => $proceso_mascotas->codigo,
        "nombre"           => $proceso_mascotas->nombre,
        "sexo"             => $proceso_mascotas->sexo,
        "fecha"            => $proceso_mascotas->fecha,
        "color"            => $proceso_mascotas->color1,
        "color_secundario" => $proceso_mascotas->color2,
        "esterilizado"     => $proceso_mascotas->esterilizado,
        "tipo"             => $proceso_mascotas->tipo,
        "imagen"           => "imagenes/" . $_FILES["imagen-mascota"]["name"],
        "qr"               => 'codigosQr/' . $proceso_mascotas->codigo . '.png',
        "raza"             => $proceso_mascotas->raza,
        "tenedor"          => $proceso_tenedor->cedula,
        "empresa"          => $_SESSION['empresa']['idempresa'],
        "chip" =>$proceso_mascotas->chip
    ];

    $resp  = $obj->listarprovinciades($proceso_tenedor->provincia);
    $resp1 = $obj->listarcantondes($proceso_tenedor->canton);
    $resp2 = $obj->listarparroquiades($proceso_tenedor->parroquia);
    //mascota
    $resp3 = $obj->listarrazades($proceso_mascotas->raza);
    $resp4 = $obj->listartipodes($proceso_mascotas->tipo);

    crear_qr($mascota, $tenedor, $resp, $resp1, $resp2, $resp3, $resp4);

    $obj->registrar_mascota($mascota);
    //cambiar el estado de chip ya utilizado a estado=2
    $obj->EstadoChip($proceso_mascotas->codigo,2,$_SESSION['empresa']['idempresa'],$_SESSION['sucursal']['codigo']);
    $mensaje = "Proceso Realizado Correctamente";
}

envio_tenedor($proceso_tenedor, $proceso_mascotas);
envio_admin($proceso_tenedor, $proceso_mascotas, $ok);

$respuesta = [
    "res"     => $res,
    "mensaje" => $mensaje,
];

print_r(json_encode($respuesta));

function crear_qr($mascota, $tenedor, $provincia, $canton, $parroquia, $raza, $tipo)
{
   

    require_once "../../app/contenido/librerias/phpqrcode/qrlib.php";
    $dir       = "../../codigosQr/";
    $filename  = $dir . $mascota['codigo'] . ".png";
    $tam       = "2";
    $level     = "L";
    $frameSize = 1;
    $contenido = "\n\t Codigo: " . $mascota['codigo'] .
        "\n\t Nombre Mascota: " . $mascota['nombre'] .
        "\n\t Sexo: " . $mascota['sexo'] .
        "\n\t Raza: " . $raza[0]['descripcion'] .
        "\n\t Especie: " . $tipo[0]['descripcion'] .
        "\n\t Esterelizado: " . $mascota['esterilizado'] .
        "\n\t Primer Nombre: " . $tenedor['primer_nombre'] .
        "\n\t Segundo Nombre : " . $tenedor['segundo_nombre'] .
        "\n\t Apellido Paterno: " . $tenedor['apellido_paterno'] .
        "\n\t Apellido Materno: " . $tenedor['apellido_materno'] .
        "\n\t Celular: " . $tenedor['celular'] .
        "\n\t Correo: " . $tenedor['correo'] .
        "\n\t Provincia: " . $provincia[0]['PROVINCIA'] .
        "\n\t Canton: " . $canton[0]['CANTON'] .
        "\n\t Parroquia: " . $parroquia[0]['PARROQUIA'] .
        "\n\t Barrio: " . $tenedor['barrio'] .
        "\n\t Numero Casa: " . $tenedor['numero'] .
        "\n\t Calle Principal: " . $tenedor['calle_principal'] .
        "\n\t Calle Secundaria: " . $tenedor['calle_secundaria'];

    Qrcode::png($contenido, $filename, $level, $tam, $frameSize);
}

function envio_tenedor($tenedor, $mascota)
{
   
    $servicio = new ServicioCorreos;
    $sms      = "Reciba un saludo cordial de parte de la empresa mascota urbana el <br> registro del tenedor:cedula->" . $tenedor->cedula . "<br>primer_nombre->" . $tenedor->primer_nombre . "<br>segundo_nombre->" . $tenedor->segundo_nombre . "<br>apellido_paterno->" . $tenedor->apellido_paterno . "<br>apellido_materno->" . $tenedor->apellido_materno . "<br>fecha->" . $tenedor->fecha . "<br>correo->" . $tenedor->correo . "<br>celular->" . $tenedor->celular . "<br>provincia->" . $tenedor->provincia . "<br>canton->" . $tenedor->canton . "<br>parroquia->" . $tenedor->parroquia . "<br>barrio->" . $tenedor->barrio . "<br>calle_principal->" . $tenedor->calle_principal . "<br>calle_secundaria->" . $tenedor->calle_secundaria . "<br>numero casa->" . $tenedor->numero_casa . "<br>referencia casa->" . $tenedor->referencia_casa . "<br>MASCOTA:" . "codigo->" . $mascota->codigo . "<br>nombre" . $mascota->nombre . "<br>sexo->" . $mascota->sexo . "<br>fecha->" . $mascota->fecha . "<br>color->" . $mascota->color1 . "<br>color_secundario->" . $mascota->color2 . "<br>esterilizado->" . $mascota->esterilizado ."<br> Se ha realizado de manera exitosa";

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
    $sms      = "La empresa" . $_SESSION['empresa']['nombre'] . "ha" . $men . " <br> los siguientes datos del Tenedor:cedula->" . $tenedor->cedula . "<br>primer_nombre->" . $tenedor->primer_nombre . "<br>segundo_nombre->" . $tenedor->segundo_nombre . "<br>apellido_paterno->" . $tenedor->apellido_paterno . "<br>apellido_materno->" . $tenedor->apellido_materno . "<br>fecha->" . $tenedor->fecha . "<br>correo->" . $tenedor->correo . "<br>celular->" . $tenedor->celular . "<br>provincia->" . $tenedor->provincia . "<br>canton->" .  $tenedor->canton . "<br>parroquia->" . $tenedor->parroquia . "<br>barrio->" . $tenedor->barrio . "<br>calle_principal->" . $tenedor->calle_principal . "<br>calle_secundaria->" . $tenedor->calle_secundaria . "<br>numero casa->" . $tenedor->numero_casa . "<br>referencia casa->" . $tenedor->referencia_casa . "<br>MASCOTA:" . "<br>codigo->" . $mascota->codigo . "<br>nombre" . $mascota->nombre . "<br>sexo->" . $mascota->sexo . "<br>fecha->" . $mascota->fecha . "<br>color->" . $mascota->color1 . "<br>color_secundario->" . $mascota->color2 . "<br>esterilizado->" . $mascota->esterilizado . "<br> Se ha realizado de manera exitosa";

    $servicio->enviar_email("koriche001@gmail.com", $sms);
    
}