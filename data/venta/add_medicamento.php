<?php

$res     = false;
$mensaje = '';

session_start();
if (isset($_SESSION['ventas'])) {
    foreach ($_SESSION['ventas'] as $datos) {
        $d = explode('||', $datos);
        if ($d[0] == $_POST['codigo']) {
            $res = true;
        }
    }
}

if ($res) {
    $mensaje = "El Articulo Ya se Encuentra en el Detalle";
} else {

    $adchb_medicamento = $_POST['codigo'] . '||' .
        $_POST['nombre'] . '||' .
        $_POST['descripcion'] . '||' .
        $_POST['cantidad'] . '||' .
        $_POST['precio'] . '||' .
        $_POST['id'];
    $_SESSION['ventas'][] = $adchb_medicamento;
}

$respuesta = [
    "res"     => $res,
    "mensaje" => $mensaje,
];

print_r(json_encode($respuesta));