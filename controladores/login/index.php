<?php

require_once '../../clases/login.php';
$obj          = new Login;
$res          = false;
$sms          = "Acceso incorrecto";
$data         = [];
$tipo         = 0;
$confirmation = $obj->verify_user($_POST);

if ($confirmation) {

    $obj->get_user($_POST);
    $obj->get_company($_POST);
    $res  = true;
    $sms  = "Acceso Correcto";
    $data = $obj->list_sucursalaes($_SESSION['empresa']['idempresa']);
    $tipo = 1;

} else {

    $ok = $obj->verify_tenedor($_POST);

    if ($ok) {

        $obj->get_tenedor($_POST);
        $obj->get_mascotas($_SESSION['tenedor']['datos']->cedula);
        $res  = true;
        $sms  = "Acceso Correcto";
        $tipo = 2;
    }

}

$dto = [
    "res"  => $res,
    "sms"  => $sms,
    "data" => $data,
    "tipo" => $tipo,
];

print_r(json_encode($dto));
