<?php
session_start();
date_default_timezone_set("America/Guayaquil");
$fecha = date("Y-m-d");
require_once '../../clases/ClientesModel.php';
$cliente = new ClientesModel;

require_once '../../clases/NotasCredito.php';
$venta = new NotasCredito;

require_once '../../helpers/funciones.php';
class NotasCreditoController
{
    private function CrearNumeroEmision($fecha, $secuencia)
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
        $digitoVerificador = self::Modulo11($claveAcceso);
        $numeroEmision     = $claveAcceso . $digitoVerificador;
        return $numeroEmision;
    }

    private function Modulo11($claveAcceso)
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

    public function RegistrarFactura($factura, $cliente)
    {
        $venta = new NotasCredito;
        $secuencia = $venta->GetNumero($_SESSION['empresa']['idempresa']);
        $numero = secuenciales($secuencia, 9);
        $factura["emision"]       = self::CrearNumeroEmision($factura["fecha"], $numero);
        $fecha                    = explode("-", $factura["fecha"]);
        $fecha                    = array_reverse($fecha);
        $fecha                    = implode("/", $fecha);
        $factura["xml"]           = self::CrearXml($factura, $cliente, $fecha);
        //print_r($factura["emision"]);
        //print_r($factura['xml']);
        $obj = new NotasCredito();
               
        $regisven = $obj->AddVenta($factura);
        
        //echo "1";
       
    }

    public function RegistrarDetalle()
    {
      
        $venta = new NotasCredito;
        
$secuencia = $venta->GetNumeroDetalle($_SESSION['empresa']['idempresa']);
$numero = secuenciales($secuencia, 9);
$detalleVenta = json_decode($_POST['detalle']);
foreach($detalleVenta as $obj){
    
    $objDetalle = [
        "cantidad" => $obj->cantidad,
        "precio" => $obj->precio,
        "total" => $obj->precio*$obj->cantidad,
        "venta" => $numero,
        "articulo" => $obj->id,
        "empresa" => $_SESSION['empresa']['idempresa']
    ];
   $stock  = $venta->StockAnteriorInventario($obj->id);
   $sumas = $stock + $obj->cantidad;
   $venta->ActualizarStockInventario($sumas, $obj->id);
    
   $venta->AddDetalle($objDetalle);
   //print_r($objDetalle);
   

    }

    }

    public function CrearXml($factura, $cliente, $fecha)
    {
        $venta = new NotasCredito;
$secuencia = $venta->GetNumero($_SESSION['empresa']['idempresa']);
$numero = secuenciales($secuencia, 9);

        $fecha                    = explode("-", $factura["fecha"]);
        $fecha                    = array_reverse($fecha);
        $fecha                    = implode("/", $fecha);
        $formatoXml = '<?xml version="1.0" encoding="UTF-8"?>

        <notaCredito id="comprobante" version="1.0.0">
            <infoTributaria>
                <ambiente>1</ambiente>
                <tipoEmision>1</tipoEmision>
                <razonSocial>' . $_SESSION['empresa']['nombre'] . '</razonSocial>
                <nombreComercial>' . $_SESSION['empresa']['nombre'] . '</nombreComercial>
                <ruc>' . $_SESSION['empresa']['ruc'] . '</ruc>
                <claveAcceso>' . self::CrearNumeroEmision($fecha, $numero) . '</claveAcceso>
                <codDoc>01</codDoc>
                <estab>' . $_SESSION['sucursal']['numest'] . '</estab>
                <ptoEmi>' . $_SESSION['sucursal']['numfact'] . '</ptoEmi>
                <secuencial>' .$numero . '</secuencial>
                <dirMatriz>' . $_SESSION['empresa']['direccion'] . '</dirMatriz>
            </infoTributaria>
            <infoNotaCredito>
                <fechaEmision>' . $fecha . '</fechaEmision>
                
                <dirEstablecimiento>Sebastián Moreno S/N Francisco García</ dirEstablecimiento>
                <tipoIdentificacionComprador>04</ tipoIdentificacionComprador >
                <razonSocialComprador>PRUEBAS SERVICIO DERENTAS
INTERNAS</razonSocialComprador>
<identificacionComprador>1713328506001</identificacionComprador> 
<contribuyenteEspecial>5368</contribuyenteEspecial>
<obligadoContabilidad>SI</ obligadoContabilidad>
<rise>Contribuyente Régimen Simplificado RISE</rise>
<codDocModificado>01</codDocModificado>
<numDocModificado>002-001-000000001</numDocModificado>
<fechaEmisionDocSustento>21/10/2011</fechaEmisionDocSustento> 
<totalSinImpuestos>295000.00</totalSinImpuestos> 
<valorModificacion>346920.00</valorModificacion> 
<moneda>DOLAR</moneda>

<totalConImpuestos>
<totalImpuesto>
    <codigo>2</codigo>
    <codigoPorcentaje>2</codigoPorcentaje>
    
    <baseImponible>' . $factura["subtotal"] . '</baseImponible>
    <tarifa>12.00</tarifa>
    <valor>' . $factura["iva"] . '</valor>
</totalImpuesto>
</totalConImpuestos>
<motivo>DEVOLUCIÓN</motivo> 

            </infoNotaCredito>
            <detalles>';
            $venta = new NotasCredito;
       
$secuencia = $venta->GetNumero($_SESSION['empresa']['idempresa']);
$numero = secuenciales($secuencia, 9);
            $detalleVenta = json_decode($_POST['detalle']);
            foreach($detalleVenta as $obj){
                $subtotal=number_format($obj->precio,2);
                $iva=number_format($obj->precio*0.12,2);
                $total=number_format($subtotal+$iva,2);
    
      
                $objDetalle = [
                    "cantidad" => $obj->cantidad,
                    "precio" => $obj->precio,
                    "detalle" => $obj->detalle,
                    "total" => $obj->precio*$obj->cantidad,
                    "venta" => $numero,
                    "articulo" => $obj->id,
                    "empresa" => $_SESSION['empresa']['idempresa']
                ];
                
            
                $formatoXml .= '<detalle>
        
                <codigoPrincipal>' . $obj->id . '</codigoPrincipal>
                <codigoAuxiliar>' . $obj->id . '</codigoAuxiliar>
                <descripcion>' . $obj->detalle . '</descripcion>
                <cantidad>' . $obj->cantidad . '</cantidad>
                <precioUnitario>' . $subtotal . '</precioUnitario>
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
                <campoAdicional nombre="AgentedeRetenci贸n">No.Resoluci贸n: 1</campoAdicional>
            </infoAdicional>
        </notaCredito>';
        return $formatoXml;
       
    }
        
    }

    

$obj = new NotasCreditoController;
  


//crear array


$objCliente = [
    
    "id"=>$_POST['ruc'],
];



$secuencia = $venta->GetNumero($_SESSION['empresa']['idempresa']);
$numero = secuenciales($secuencia, 9);

$objVenta = [
    "numero"=>$numero,
    "fecha"=>$_POST['fecha'],
    "subtotal"=>$_POST['subtotal'],
    "iva"=>$_POST['iva'],
    "total"=>$_POST['total'],
    "cliente"=>$_POST['ruc'],
    "empresa"=>$_SESSION['empresa']['idempresa'],
    "emision"=>"",
    "sucursal"=>$_SESSION['sucursal']['codigo'],
    "estado"=>1,
    "xml"=> "",
    "descuento"=>$_POST['descuento']
];



echo "Venta realizada correctamente";

//print_r($objVenta);
//print_r($objCliente);

$obj->RegistrarFactura($objVenta,$objCliente);
$obj->RegistrarDetalle();


?>