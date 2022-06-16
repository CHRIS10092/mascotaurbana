<?php
require_once "clases/nueva_venta.php";
try {
    require_once 'app/librerias/nusoap/src/nusoap.php';
    $url    = 'https://celcer.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl';
    $client = new SoapClient($url);

    $result = $client->autorizacionComprobante(array("claveAccesoComprobante" => '1405202201172229668600110010040000000501234567812'));
    //return $result;
    //print_r($result);
    //echo "";
    $mensaje = "";
    $estado  = "";
    //guardar en la base de datos tbl respuestas
    $obj                = new nueva_venta();
    $estadoAutorizacion = $result->RespuestaAutorizacionComprobante->autorizaciones->autorizacion->estado;
    if ($estadoAutorizacion == "NO AUTORIZADO") {

        $codfactura = $result->RespuestaAutorizacionComprobante->claveAccesoConsultada;
        $mensaje    = $result->RespuestaAutorizacionComprobante->autorizaciones->autorizacion->mensajes->mensaje->mensaje;
        $xml        = $result->RespuestaAutorizacionComprobante->autorizaciones->autorizacion->comprobante;
        $estado     = $estadoAutorizacion;

        // $obj->Registrar_Respuestas($codfactura, $mensaje, $xml);

    }

    echo "<pre>";
    print_r($result);
    //print($codfactura);
    //print($mensaje);
    //print($xml);

    echo "</pre>";

} catch (SoapFault $e) {
    return $e;
}
