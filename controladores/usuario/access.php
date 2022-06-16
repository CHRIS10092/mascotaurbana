<?php
//session_start();
$res        = false;
$mensaje    = 'Acceso Incorrecto Verifique su contrasenia ';
$tipo       = 0;
$sucursales = null;

if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    require_once '../../clases/usuario.php';
    $adchb_usuario = new usuario();

    $tipo = $_POST['tipo'];

    if ($tipo == '1') {

        $permiso     = $adchb_usuario->verificar_permisos($_POST['usuario'], $_POST['clave']);
        $adchb_datos = [
            $_POST['usuario'],
            $_POST['clave'],
        ];
        $ok = $adchb_usuario->VerificarLogin($adchb_datos);

        if ($permiso && $ok) {
            $usuario = $adchb_usuario->TraerUsuarioLogin($_POST['usuario'], $_POST['clave']);
            $adchb_usuario->TraerEmpresaLogin($_POST['usuario'], $_POST['clave']);
            $adchb_usuario->TraerSucursalLogin($_POST['usuario'], $_POST['clave']);

            //$adchb_usuario->DatosUsuario1($adchb_datos);
            $res     = true;
            $mensaje = 'ACESSO CORRECTO ';

        }

        $retorno = [
            'res'        => $res,
            'mensaje'    => $mensaje,
            'tipo'       => $tipo,
            'sucursales' => $sucursales,
        ];

        print_r(json_encode($retorno));

    } else {

        if ($adchb_usuario->verificar_tenedor($_POST['usuario'], $_POST['clave'])) {
            $res      = true;
            $tenedor  = $adchb_usuario->obtener_tenedor($_POST['usuario'], $_POST['clave']);
            $mascotas = $adchb_usuario->obtener_mascotas($tenedor->cedula);

            $_SESSION['clientes'] = [
                "tenedor"  => $tenedor,
                "mascotas" => $mascotas,
            ];
            $mensaje = 'ACESSO CORRECTO ';

        }

        $respuesta = [
            "res"        => $res,
            "mensaje"    => $mensaje,
            "tipo"       => $tipo,
            'sucursales' => $sucursales,
        ];

        print_r(json_encode($respuesta));

    }

} else {
    echo "<script>window.location.href='../../'</script>";
}
