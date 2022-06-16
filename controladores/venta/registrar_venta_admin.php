<?php
date_default_timezone_set("America/Guayaquil");
$fecha = date("Y-m-d");
require_once "../../clases/nueva_venta.php";
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

        $factura["numeroEmision"] = self::CrearNumeroEmision($factura["fecha"], $factura["numero"]);
        $fecha                    = explode("-", $factura["fecha"]);
        $fecha                    = array_reverse($fecha);
        $fecha                    = implode("/", $fecha);
        $factura["xml"]           = self::CrearXml($factura, $cliente, $fecha);

        $obj = new nueva_venta();
        $rs  = $obj->VerificarDuplicadoCliente($factura['rucci']);
        if (!$rs) {
            $regiscli = $obj->Registrar_Cliente($cliente);
        }

        $regisven = $obj->Registrar_VentaAdmin($factura);
        echo "1";
    }

    public function RegistrarDetalle()
    {

        $obj = new nueva_venta();
        foreach ($_SESSION['ventas'] as $datos) {
            $detalle = explode('||', $datos);

            $obj->Registrar_Detalle(
                $detalle[3],
                $detalle[4],
                $detalle[3] * $detalle[4],
                $_POST['numero'],
                $detalle[5],
                '00001'
            );

            $stock  = $obj->StockAnteriorInventario($detalle[5]);
            $restas = $stock - $detalle[3];
            $obj->ActualizarStockInventario($restas, $detalle[5]);
        }
        unset($_SESSION['ventas']);
    }

    public function CrearXml($factura, $cliente, $fecha)
    {

        $formatoXml = '<?xml version="1.0" encoding="UTF-8"?>

<factura version="1.0.0" id="comprobante">
    <infoTributaria>
        <ambiente>1</ambiente>
        <tipoEmision>1</tipoEmision>
        <razonSocial>' . $_SESSION['empresa']['nombre'] . '</razonSocial>
        <nombreComercial>' . $_SESSION['empresa']['nombre'] . '</nombreComercial>
        <ruc>' . $_SESSION['empresa']['ruc'] . '</ruc>
        <claveAcceso>' . $factura['numeroEmision'] . '</claveAcceso>
        <codDoc>01</codDoc>
        <estab>' . $_SESSION['sucursal']['numest'] . '</estab>
        <ptoEmi>' . $_SESSION['sucursal']['numfact'] . '</ptoEmi>
        <secuencial>' . $factura['numero'] . '</secuencial>
        <dirMatriz>' . $_SESSION['empresa']['direccion'] . '</dirMatriz>
    </infoTributaria>
    <infoFactura>
        <fechaEmision>' . $fecha . '</fechaEmision>
        <obligadoContabilidad>NO</obligadoContabilidad>
        <tipoIdentificacionComprador>04</tipoIdentificacionComprador>
        <razonSocialComprador>' . $cliente["nombre"] . " " . $cliente["apellido"] . '</razonSocialComprador>
        <identificacionComprador>' . $cliente["rucci"] . '</identificacionComprador>
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
        foreach ($_SESSION['ventas'] as $datos) {
        $detalle = explode('||', $datos);
        $iva = $detalle[4] * 0.12;
        $subtotal = $detalle[4] - $iva;
        $formatoXml .= '<detalle>

            <codigoPrincipal>' . $detalle[5] . '</codigoPrincipal>
            <codigoAuxiliar>' . $detalle[5] . '</codigoAuxiliar>
            <descripcion>' . $detalle[1] . '</descripcion>
            <cantidad>' . $detalle[3] . '</cantidad>
            <precioUnitario>' . $detalle[3] * $detalle[4] . '</precioUnitario>
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
}

$obj = new VentasAdminController;
$datosFactura = [
"rucci" => $_POST['ruc'],
"numero" => $_POST['numero'],
"fecha" => date("Y-m-d"),
"subtotal" => $_POST['subtotal'],
"iva" => $_POST['iva'],
"total" => $_POST['total'],
"idempresa" => $_SESSION['empresa']['idempresa'],
"idsucursal" => $_SESSION['sucursal']['codigo'],
"estado" => 1,
"xml" => "",
"numeroEmision" => "",
];

$datosCliente = [
"nombre" => $_POST['nombre'],
"apellido" => "xxxxx",
"direccion" => $_POST['direccion'],
"rucci" => $_POST['ruc'],
"correo" => $_POST['correo'],
"celular" => $_POST['celular'],
"idempresa" => $_SESSION['empresa']['idempresa'],
];

//print_r($datosFactura);
//print_r($datosCliente);
$obj->RegistrarFactura($datosFactura, $datosCliente);
$obj->RegistrarDetalle();