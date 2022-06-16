<?php
require_once "../../clases/Sri.php";
/**
 *
 */class RespuestaController
{

    //insertar en la base si exite los datos
    public function insertarRespuetaRecepcion($codfactura, $mensaje, $mensajeAdicional)
    {
        $obj = new Sri();
        $obj->insertarResRecepcion($codfactura, $mensaje, $mensajeAdicional);
    }
    public function insertarRespuetaAutorizacion($datos)
    {
        $obj = new Sri();
        $obj->insertarResAutorizacion($datos);
    }

}
$obj = new RespuestaController;
//aqui cambiar el estado de la factura para colocar 2 cuando este recibido
$obj->insertarRespuetaRecepcion($_POST['mensaje'], $_POST['informacionAdicional'], $_POST['identificador']);
//aqui guardar en la tabla respuestas
//$obj->insertarRespuetaAutorizacion($_POST['xml']);
