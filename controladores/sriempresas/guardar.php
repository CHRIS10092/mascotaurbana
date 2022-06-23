<?php
session_start();
require_once "../../clases/SriEmpresas.php";




$obj = new SriEmpresas();
//aqui cambiar el estado de la factura para colocar 2 cuando este recibido

$idempresa=$_SESSION['empresa']['idempresa'];
$idsucursal=$_SESSION['sucursal']['codigo'];


echo $obj->insertarResRecepcion($_POST['mensaje'], $_POST['informacionAdicional'], $_POST['identificador'],$idempresa,$idsucursal);
//echo 'Datos Guardos Correctos';
//print_r($_POST);
//print_r($_SESSION['empresa']['idempresa']);
//print_r($_SESSION['sucursal']['codigo']);
//aqui guardar en la tabla respuestas
//$obj->insertarRespuetaAutorizacion($_POST['xml']);
