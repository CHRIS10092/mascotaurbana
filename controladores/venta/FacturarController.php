<?php 
session_start();
require_once '../../clases/ClientesModel.php';
$cliente = new ClientesModel;

require_once '../../clases/VentasModel.php';
$venta = new VentasModel;

require_once '../../helpers/funciones.php';

function CrearNumeroEmision($fecha, $secuencia)
    {
        date_default_timezone_set("America/Guayaquil");
        $fecha = date("Y-m-d");

        $fecha             = explode("-", $fecha);
        $fecha             = array_reverse($fecha);
        $fecha             = implode("", $fecha);
        $tipoComprobante   = "01";
        $numeroRuc         = $_SESSION['empresa']['ruc'];
        $tipoAmbiente      = $_SESSION['empresa']['ambiente'];
        $serie             = $_SESSION['sucursal']['numest'] . $_SESSION['sucursal']['numfact'];
        $secuencial        = $secuencia;
        $codigoNumerico    = "12345678";
        $tipoEmision       = 1;
        $claveAcceso       = $fecha . $tipoComprobante . $numeroRuc . $tipoAmbiente . $serie . $secuencial . $codigoNumerico . $tipoEmision;
        $digitoVerificador = Modulo11($claveAcceso);
        $numeroEmision     = $claveAcceso . $digitoVerificador;
        return $numeroEmision;
    }
      function Modulo11($claveAcceso)
    {

        while ($claveAcceso[0] == "0") {
            $claveAcceso = substr($claveAcceso, 1);
        }
        $factor = 2;
        $suma   = 0;
        for ($i = strlen($claveAcceso) - 1; $i >= 0; $i--) {
            $suma += $factor * $claveAcceso[$i];
            $factor = $factor % 7 == 0 ? 2 : $factor + 1;
        }
        $digitoVerificador = 11 - $suma % 11;

        $digitoVerificador = $digitoVerificador == 11 ? 0 : ($digitoVerificador == 10 ? 1 : $digitoVerificador);
        return $digitoVerificador;
    }

  function CrearXml($factura, $cliente, $fecha)
    {
        require_once '../../clases/VentasModel.php';
        $venta = new VentasModel;
        $secuencia = $venta->GetNumero($_SESSION['empresa']['idempresa']);
        $numero = secuenciales($secuencia, 9);
        
        $formatoXml = '<?xml version="1.0" encoding="UTF-8"?>

<factura version="1.0.0" id="comprobante">
    <infoTributaria>
        <ambiente>1</ambiente>
        <tipoEmision>1</tipoEmision>
        <razonSocial>' . $_SESSION['empresa']['nombre'] . '</razonSocial>
        <nombreComercial>' . $_SESSION['empresa']['nombre'] . '</nombreComercial>
        <ruc>' . $_SESSION['empresa']['ruc'] . '</ruc>
        <claveAcceso>' . CrearNumeroEmision($fecha,$numero) . '</claveAcceso>
        <codDoc>01</codDoc>
        <estab>' . $_SESSION['sucursal']['numest'] . '</estab>
        <ptoEmi>' . $_SESSION['sucursal']['numfact'] . '</ptoEmi>
        <secuencial>' . $numero . '</secuencial>
        <dirMatriz>' . $_SESSION['empresa']['direccion'] . '</dirMatriz>
    </infoTributaria>
    <infoFactura>
        <fechaEmision>' . $fecha . '</fechaEmision>
        <obligadoContabilidad>NO</obligadoContabilidad>
        <tipoIdentificacionComprador>04</tipoIdentificacionComprador>
        <razonSocialComprador>' . $cliente["nombre"] . " " . $cliente["apellido"] . '</razonSocialComprador>
        <identificacionComprador>' . $cliente["ruc"] . '</identificacionComprador>
        <direccionComprador>' . $cliente["direccion"] . '</direccionComprador>
        <totalSinImpuestos>' . $factura["total"] . '</totalSinImpuestos>
        <totalDescuento>0.00</totalDescuento>
        <totalConImpuestos>
            <totalImpuesto>
                <codigo>2</codigo>
                <codigoPorcentaje>2</codigoPorcentaje>
                <descuentoAdicional>0.00</descuentoAdicional>
                <baseImponible>' . $factura["subtotal"] . '</baseImponible>
                <tarifa>12.00</tarifa>
                <valor>' . $factura["iva"] . '</valor>
            </totalImpuesto>
        </totalConImpuestos>
        <propina>0.00</propina>
        <importeTotal>' . $factura["total"] . '</importeTotal>
        <moneda>DOLAR</moneda>
        <pagos>
            <pago>
                <formaPago>01</formaPago>
                <total>' . $factura["total"] . '</total>
            </pago>
        </pagos>
    </infoFactura>
    <detalles>';
        require_once '../../clases/VentasModel.php';
$venta = new VentasModel;
$secuencia = $venta->GetNumero($_SESSION['empresa']['idempresa']);
$numero = secuenciales($secuencia, 9);

        $detalleVenta = json_decode($_POST['detalle']);
        //print_r($detalleVenta);
foreach($detalleVenta as $obj){
$subtotal=$obj->precio;
$iva=$obj->preciopvp-$obj->precio;
$total=$obj->preciopvp;
        
    $objDetalle = [
        "cantidad" => $obj->cantidad,
        "precio" => $obj->precio,
        "total" => $obj->preciopvp,
        "venta" => $numero,
        "articulo" => $obj->id,
        "empresa" => $_SESSION['empresa']['idempresa']
    ];
    
        $formatoXml .= '<detalle>

            <codigoPrincipal>' . $obj->id . '</codigoPrincipal>
            <codigoAuxiliar>' . $obj->id . '</codigoAuxiliar>
            <descripcion>' . $obj->id . '</descripcion>
            <cantidad>' . $obj->cantidad . '</cantidad>
            <precioUnitario>' . $obj->cantidad * $obj->precio . '</precioUnitario>
            <descuento>0</descuento>
            <precioTotalSinImpuesto>' . $subtotal . '</precioTotalSinImpuesto>';

            $formatoXml .= '<impuestos>
                <impuesto>
                    <codigo>2</codigo>
                    <codigoPorcentaje>2</codigoPorcentaje>
                    <tarifa>12.00</tarifa>
                    <baseImponible>' . $subtotal . '</baseImponible>
                    <valor>' . $iva . '</valor>
                </impuesto>
            </impuestos>
        </detalle>';
        }
        $formatoXml .= '</detalles>
    <infoAdicional>
        <campoAdicional nombre="DIRECCION">CDLA IBARRA 000</campoAdicional>
        <campoAdicional nombre="AgentedeRetención">No.Resolución: 1</campoAdicional>
    </infoAdicional>
</factura>';
return $formatoXml;
}

$idCliente = null;
$idVenta = null;

$objCliente = [
    "ruc"=>$_POST['ruc'],
    "correo"=>$_POST['correo'],
    "direccion"=>$_POST['direccion'],
    "celular"=>$_POST['celular'],
    "nombre"=>$_POST['cliente'],
    "apellido"=>$_POST['apellido'],
    "empresa"=>$_SESSION['empresa']['idempresa'],
    "id"=>$_POST['idcliente'],
];


if($_POST['idcliente'] == "" ){
   $cliente->AddCliente($objCliente);
   $idCliente = $cliente->UltimateCliente();
}else{
  $cliente->UpdateCliente($objCliente);
  $idCliente = $_POST['idcliente'];
}

$secuencia = $venta->GetNumero($_SESSION['empresa']['idempresa']);
$numero = secuenciales($secuencia, 9);
$detalleChips = $_POST['chipsDetails'];
$estadoChips = 'E';
if($_POST['chipsDetails'] != '[]'){
    $estadoChips = 'P';
}

$objVenta = [
    "numero"=>$numero,
    "fecha"=>$_POST['fecha'],
    "subtotal"=>$_POST['subtotal'],
    "iva"=>$_POST['iva'],
    "total"=>$_POST['total'],
    "cliente"=>$idCliente,
    "empresa"=>$_SESSION['empresa']['idempresa'],
    "emision"=>CrearNumeroEmision($_POST['fecha'],$numero),
    "sucursal"=>$_SESSION['sucursal']['codigo'],
    "estado"=>1,
    "xml"=>CrearXml($objVenta,$objCliente,$_POST['fecha']),
    "detalleChips"=>$_POST['chipsDetails'],
    "estadoChips"=>$estadoChips
];

$venta->AddVenta($objVenta);

$idVenta = $venta->UltimateVenta();

$detalleVenta = json_decode($_POST['detalle']);
foreach($detalleVenta as $obj){
    $objDetalle = [
        "cantidad" => $obj->cantidad,
        "precio" => $obj->precio,
        "total" => $obj->preciopvp,
        "venta" => $numero,
        "articulo" => $obj->id,
        "empresa" => $_SESSION['empresa']['idempresa']
    ];
   $stock  = $venta->StockAnteriorInventario($obj->id);
   $restas = $stock - $obj->cantidad;
   $venta->ActualizarStockInventario($restas, $obj->id);
    
   $venta->AddDetalle($objDetalle);
}

echo "Venta realizada correctamente";

   // print_r($objVenta);
//print_r($objCliente);
  //  print_r($objVenta['emision']);

    
?>