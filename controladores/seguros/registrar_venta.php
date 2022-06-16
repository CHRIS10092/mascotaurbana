<?php

require_once '../../clases/seguros.php';
$obj = new seguros;
require_once '../servidor_correos/servicioCorreos.php';

$factura         = json_decode($_POST['factura']);
$factura_cliente = $factura->cliente;
$cliente         = [
    "rucci"     => $factura_cliente->rucci,
    "nombre"    => $factura_cliente->nombre,
    "apellido"  => $factura_cliente->apellido,
    "direccion" => $factura_cliente->direccion,
    "correo"    => $factura_cliente->correo,
    "celular"   => $factura_cliente->celular,
    "empresa"   => $_SESSION['usuario'][6],

];

$venta = [

    "numero"   => $factura->numero,
    "fecha"    => $factura->fecha,
    "subtotal" => $factura->subtotal,
    "iva"      => $factura->iva,
    "total"    => $factura->total,
    "tipo"     => 1,
    "cliente"  => $factura_cliente->rucci,
    "empresa"  => $_SESSION['usuario'][6],
];

$items = $factura->detalle;

if ($obj->verificar_cliente($factura_cliente->rucci, $_SESSION['usuario'][6])) {
    $obj->actualizar_cliente($cliente);
} else {
    $obj->registrar_cliente($cliente);
}

$obj->registrar_venta($venta);

for ($i = 0; $i < count($items); $i++) {
    $total = $items[$i]->cantidad * $items[$i]->precio;

    $detalle = [
        "cantidad" => $items[$i]->cantidad,
        "precio"   => $items[$i]->precio,
        "total"    => $total,
        "venta"    => $factura->numero,
        "articulo" => $items[$i]->articulo,
    ];

    $cantidad_actual = $obj->stock_actual($items[$i]->articulo, $_SESSION['usuario'][6]);
    $cantidad_nueva  = $cantidad_actual - $items[$i]->cantidad;
    $obj->registrar_detalle($detalle);
    $obj->actualizar_stock($cantidad_nueva, $items[$i]->articulo, $_SESSION['usuario'][6]);

}

$res     = true;
$mensaje = "Venta Realizada Correctamente";

envio_cliente($factura_cliente, $factura);
envio_admin($items, $factura_cliente);

$respuesta = [
    "mensaje" => $mensaje,
    "res"     => $res,

];

print_r(json_encode($respuesta));

function envio_cliente($cliente, $factura)
{

    $servicio = new ServicioCorreos;
    $sms      = "Cliente Reciba un cordial saludo de parte de la empresa Mascota Urbana,su venta de chips para el RUC/CI:" . $cliente->rucci . "Nombre:" . $cliente->nombre . "Apellido:" . $cliente->apellido . "Direccion:" . $cliente->direccion . "Telefono:" . $cliente->celular . "Correo:" . $cliente->correo . "Factura:" . $factura->numero;

    $servicio->enviar_email($cliente->correo, $sms);

}

function envio_admin($items, $cliente)
{

    //session_start();

    $servicio = new ServicioCorreos;
    $sms      = "La empresa" . $_SESSION['usuario'][5] . " ha vendido los siguientes productos:";

    for ($i = 0; $i < count($items); $i++) {

        $sms .= "Cantidad" . $items[$i]->cantidad;
        $sms .= "Precio" . $items[$i]->precio;
        $sms .= "CodigoProducto" . $items[$i]->articulo;
    }

    $sms .= "al cliente RUC/CI:" . $cliente->rucci . "Nombre:" . $cliente->nombre . "Apellido:" . $cliente->apellido . "Direccion:" . $cliente->direccion . "Telefono:" . $cliente->celular . "Correo:" . $cliente->correo . "se ha realizado de manera correcta";

    $servicio->enviar_email("koriche001@gmail.com", $sms);

}
