<?php
require_once "clases/nueva_venta.php";

$formatoXml = '<?xml version="1.0" encoding="UTF-8"?>

        <factura version="1.0.0" id="comprobante">
        <infoTributaria>
        <ambiente>1</ambiente>
        <tipoEmision>1</tipoEmision>
        <razonSocial>IBC INTERNATIONAL BUSINESS CORPORATION</razonSocial>
        <nombreComercial>IBC INTERNATIONAL BUSINESS CORPORATION</nombreComercial>
        <ruc>1722296686001</ruc>
        <claveAcceso>1809202101172402417700110010040000000061234567810</claveAcceso>
        <codDoc>01</codDoc>
        <estab>001</estab>
        <ptoEmi>003</ptoEmi>
        <secuencial>000000006</secuencial>
        <dirMatriz>PICHINCHA / RUMIÑAHUI / SAN RAFAEL / PIQUEROS 43 Y MIRASIERRA</dirMatriz>
        </infoTributaria>
        <infoFactura>
        <fechaEmision>18/09/2021</fechaEmision>
        <obligadoContabilidad>NO</obligadoContabilidad>
        <tipoIdentificacionComprador>04</tipoIdentificacionComprador>
        <razonSocialComprador>Veterinaria del Xc xxxxx</razonSocialComprador>
        <identificacionComprador>1710181577001</identificacionComprador>
        <direccionComprador>Av. Mariscal Sucre</direccionComprador>
        <totalSinImpuestos>24</totalSinImpuestos>
        <totalDescuento>0.00</totalDescuento>
        <totalConImpuestos>
        <totalImpuesto>
        <codigo>2</codigo>
        <codigoPorcentaje>2</codigoPorcentaje>
        <descuentoAdicional>0.00</descuentoAdicional>
        <baseImponible>21.12</baseImponible>
        <tarifa>12.00</tarifa>
        <valor>2.88</valor>
        </totalImpuesto>
        </totalConImpuestos>
        <propina>0.00</propina>
        <importeTotal>24</importeTotal>
        <moneda>DOLAR</moneda>
        <pagos>
        <pago>
        <formaPago>01</formaPago>
        <total>24</total>
        </pago>
        </pagos>
        </infoFactura>
        <detalles>
        <detalle><codigoPrincipal>3</codigoPrincipal>
        <codigoAuxiliar>3</codigoAuxiliar>
        <descripcion>Chip</descripcion>
        <cantidad>1</cantidad>
        <precioUnitario>24</precioUnitario>
        <descuento>0</descuento>
        <precioTotalSinImpuesto>21.12</precioTotalSinImpuesto>

        <impuestos>
<impuesto>
<codigo>2</codigo>
<codigoPorcentaje>2</codigoPorcentaje>
<tarifa>12.00</tarifa>
<baseImponible>21.12</baseImponible>
<valor>2.88</valor>
</impuesto>
</impuestos>
        </detalle>
        </detalles>
        <infoAdicional>
        <campoAdicional nombre="DIRECCION">CDLA IBARRA 000</campoAdicional>
        <campoAdicional nombre="AgentedeRetención">No.Resolución: 1</campoAdicional>
        </infoAdicional>
        </factura>';
try {
require_once 'app/librerias/nusoap/src/nusoap.php';
$url = 'https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantesOffline?wsdl';
$client = new SoapClient($url);
require_once "controladores/venta/web_service_sri.php";
$obj = new WebServiceController;

//FIRMA ELECTRONICA//////////////
$factura_xml = trim(str_replace('
<?xml version="1.0" encoding="UTF-8"?>', '', $formatoXml));
$cert['certificado'] = 'certificados/NATALY MISHEL CARRERA ZUNIGA 030621205340 (2).p12';
$cert['clave'] = 'N12345M';
$factura_firmada = $obj->injectSignature(trim($factura_xml), $cert);
$factura_xml_firmada = '
<?xml version="1.0" encoding="UTF-8"?>' . "\n" . $factura_firmada;
//print_r($factura_xml_firmada);

$parametros = new stdClass();

$parametros->xml = $factura_xml_firmada;

//$parametros->xml = $formatoXml;
$result = $client->validarComprobante($parametros);

$mensaje = "";
$estado = "";
$obj = new nueva_venta();

$estadoComprobante = $result->RespuestaRecepcionComprobante->estado;
if ($estadoComprobante == "DEVUELTA") {

$datos = [

$mensaje = $result->RespuestaRecepcionComprobante->comprobantes->comprobante->mensajes->mensaje->tipo,
$mensaje1 = $result->RespuestaRecepcionComprobante->comprobantes->comprobante->mensajes->mensaje->mensaje,
$tipoerror = $result->RespuestaRecepcionComprobante->comprobantes->comprobante->mensajes->mensaje->informacionAdicional,
$estado = $estadoComprobante,

];
//print($datos[2]);
$obj->Registrar_Respuestas($datos[0], $datos[1], $datos[2]);
}

print_r($mensaje);
echo "<br />";
print_r($estado);
echo "
<pre>";
    print_r($result);
    echo "</pre>";
} catch (SoapFault $e) {

print "ERROR DEL SERVICIO: " . $e->faultcode . "-" . $e->faultstring;
}