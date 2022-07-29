<?php
session_start();
date_default_timezone_set("America/Guayaquil");
$fecha = date("Y-m-d");
require_once '../../clases/ClientesModel.php';
$cliente = new ClientesModel;

require_once '../../clases/VentasModel.php';
$venta = new VentasModel;

require_once '../../helpers/funciones.php';
class VentasAdminController
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
        $venta = new VentasModel;
        $secuencia = $venta->GetNumero($_SESSION['empresa']['idempresa']);
        $numero = secuenciales($secuencia, 9);
        $factura["emision"]       = self::CrearNumeroEmision($factura["fecha"], $numero);
        $fecha                    = explode("-", $factura["fecha"]);
        $fecha                    = array_reverse($fecha);
        $fecha                    = implode("/", $fecha);
        $factura["xml"]           = self::CrearXml($factura, $cliente, $fecha);
        //print_r($factura["emision"]);
        //print_r($factura['xml']);
        $obj = new VentasModel();
        $ruc=$_POST['ruc'];
        $rs  = $obj->VerificarDuplicadoCliente($ruc);
        if (!$rs) {
            $regiscli = $obj->Registrar_Cliente($cliente);
        }
        
        $detalleChips = $_POST['chipsDetails'];
        $estadoChips = 'E';
        if($_POST['chipsDetails'] != '[]'){
        $estadoChips = 'P';
}
        
        
        $regisven = $obj->AddVenta($factura);
        $idVenta = $obj->UltimateVenta();
        //echo "1";
       
    }

    public function RegistrarDetalle()
    {
      
        $venta = new VentasModel;
        
$secuencia = $venta->GetNumeroDetalle($_SESSION['empresa']['idempresa']);
$numero = secuenciales($secuencia, 9);
$detalleVenta = json_decode($_POST['detalle']);
foreach($detalleVenta as $obj){
    
    $objDetalle = [
        "cantidad" => $obj->cantidad,
        "precio" => $obj->precio,
        "descuento" => $obj->descuento,
        "total" => $obj->precio*$obj->cantidad,
        "venta" => $numero,
        "articulo" => $obj->id,
        "empresa" => $_SESSION['empresa']['idempresa']
    ];
   $stock  = $venta->StockAnteriorInventario($obj->id);
   $restas = $stock - $obj->cantidad;
   $venta->ActualizarStockInventario($restas, $obj->id);
    
   $venta->AddDetalle($objDetalle);
   
   //print_r($objDetalle);
}

    }

    public function CrearXml($factura, $cliente, $fecha)
    {
        $venta = new VentasModel;
$secuencia = $venta->GetNumero($_SESSION['empresa']['idempresa']);
$numero = secuenciales($secuencia, 9);

        $fecha                    = explode("-", $factura["fecha"]);
        $fecha                    = array_reverse($fecha);
        $fecha                    = implode("/", $fecha);
        $formatoXml = '<?xml version="1.0" encoding="UTF-8"?>

        <factura id="comprobante" version="1.0.0">
            <infoTributaria>
                <ambiente>2</ambiente>
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
            <infoFactura>
                <fechaEmision>' . $fecha . '</fechaEmision>
                <obligadoContabilidad>NO</obligadoContabilidad>
                <tipoIdentificacionComprador>05</tipoIdentificacionComprador>
                <razonSocialComprador>' . $cliente["nombre"] . " " . $cliente["apellido"] . '</razonSocialComprador>
                <identificacionComprador>' . $cliente["ruc"] . '</identificacionComprador>
                <direccionComprador>' . $cliente["direccion"] . '</direccionComprador>
                <totalSinImpuestos>' . $factura["total"] . '</totalSinImpuestos>
                <totalDescuento>'.$factura["descuento"].'</totalDescuento>
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
            $venta = new VentasModel;
       
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
                    "empresa" => $_SESSION['empresa']['idempresa'],
                    "descuento"=>$obj->descuento
                ];
                
            
                $formatoXml .= '<detalle>
        
                <codigoPrincipal>' . $obj->id . '</codigoPrincipal>
                <codigoAuxiliar>' . $obj->id . '</codigoAuxiliar>
                <descripcion>' . $obj->detalle . '</descripcion>
                <cantidad>' . $obj->cantidad . '</cantidad>
                <precioUnitario>' . $subtotal . '</precioUnitario>
                <descuento>'.$obj->descuento.'</descuento>
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
        </factura>';
        return $formatoXml;
       
    }
        
    }

    

$obj = new VentasAdminController;
  


//crear array
$idVenta=null;
$detalleChips = $_POST['chipsDetails'];
$estadoChips = 'E';
if($_POST['chipsDetails'] != '[]'){
    $estadoChips = 'P';
}
$objCliente = [
    "ruc"=>$_POST['ruc'],
    "correo"=>$_POST['correo'],
    "direccion"=>$_POST['direccion'],
    "celular"=>$_POST['celular'],
    "nombre"=>$_POST['cliente'],
    "apellido"=>$_POST['apellido'],
    "empresa"=>$_SESSION['empresa']['idempresa'],
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
    "detalleChips"=>$_POST['chipsDetails'],
    "estadoChips"=>$estadoChips,
    "descuento"=>$_POST['total_descuento']
];


//$venta->AddVenta($objVenta);
//$idVenta = $venta->UltimateVenta();


echo "Venta realizada correctamente";

//print_r($objVenta);
//print_r($objCliente);

$obj->RegistrarFactura($objVenta,$objCliente);
$obj->RegistrarDetalle();

