<?php
$formatoXml = '<?xml version="1.0" encoding="UTF-8"?>

        <factura version="1.0.0" id="comprobante">
        <infoTributaria>
        <ambiente>1</ambiente>
        <tipoEmision>1</tipoEmision>
        <razonSocial>IBC INTERNATIONAL BUSINESS CORPORATION</razonSocial>
        <nombreComercial>IBC INTERNATIONAL BUSINESS CORPORATION</nombreComercial>
        <ruc>1708775695001</ruc>
        <claveAcceso>1810202101172229668600110010020000000451234567816</claveAcceso>
        <codDoc>01</codDoc>
        <estab>001</estab>
        <ptoEmi>002</ptoEmi>
        <secuencial>000000045</secuencial>
        <dirMatriz>PICHINCHA / RUMIÑAHUI / SAN RAFAEL / PIQUEROS 43 Y MIRASIERRA</dirMatriz>
        </infoTributaria>
        <infoFactura>
        <fechaEmision>18/10/2021</fechaEmision>
        <obligadoContabilidad>NO</obligadoContabilidad>
        <tipoIdentificacionComprador>04</tipoIdentificacionComprador>
        <razonSocialComprador>Veterinaria Doger xxxxx</razonSocialComprador>
        <identificacionComprador>1708775695001</identificacionComprador>
        <direccionComprador>La Carolina</direccionComprador>
        <totalSinImpuestos>60</totalSinImpuestos>
        <totalDescuento>0.00</totalDescuento>
        <totalConImpuestos>
        <totalImpuesto>
        <codigo>2</codigo>
        <codigoPorcentaje>2</codigoPorcentaje>
        <descuentoAdicional>0.00</descuentoAdicional>
        <baseImponible>53.57</baseImponible>
        <tarifa>12.00</tarifa>
        <valor>6.43</valor>
        </totalImpuesto>
        </totalConImpuestos>
        <propina>0.00</propina>
        <importeTotal>60</importeTotal>
        <moneda>DOLAR</moneda>
        <pagos>
        <pago>
        <formaPago>01</formaPago>
        <total>60</total>
        </pago>
        </pagos>
        </infoFactura>
        <detalles>
        <detalle><codigoPrincipal>4</codigoPrincipal>
        <codigoAuxiliar>4</codigoAuxiliar>
        <descripcion>Dog Per</descripcion>
        <cantidad>1</cantidad>
        <precioUnitario>20</precioUnitario>
        <descuento>0</descuento>
        <precioTotalSinImpuesto>17.6</precioTotalSinImpuesto><codigoPrincipal>7</codigoPrincipal>
        <codigoAuxiliar>7</codigoAuxiliar>
        <descripcion>Huesos fd</descripcion>
        <cantidad>1</cantidad>
        <precioUnitario>40</precioUnitario>
        <descuento>0</descuento>
        <precioTotalSinImpuesto>35.2</precioTotalSinImpuesto>
        <impuestos>
<impuesto>
<codigo>7</codigo>
<codigoPorcentaje>7</codigoPorcentaje>
<tarifa>12.00</tarifa>
<baseImponible>53.57</baseImponible>
<valor>6.43</valor>
</impuesto>
</impuestos></detalle>
        </detalles>
        <infoAdicional>
        <campoAdicional nombre="DIRECCION">CDLA IBARRA 000</campoAdicional>
        <campoAdicional nombre="AgentedeRetención">No.Resolución: 1</campoAdicional>
        </infoAdicional>
        </factura>';
try {
    require_once 'app/librerias/nusoap/src/nusoap.php';
    $url    = 'https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantesOffline?wsdl';
    $client = new SoapClient($url);
    require_once "controladores/venta/web_service_sri.php";
    $obj = new WebServiceController;

//FIRMA ELECTRONICA//////////////
    $factura_xml         = trim(str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $formatoXml));
    $cert['certificado'] = 'certificados/NATALY MISHEL CARRERA ZUNIGA 030621205340 (2).p12';
    $cert['clave']       = 'N12345M';
    $factura_firmada     = $obj->injectSignature(trim($factura_xml), $cert);
    $factura_xml_firmada = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . $factura_firmada;
    //print_r($factura_xml_firmada);

    $parametros = new stdClass();

    $parametros->xml = $factura_xml_firmada;

    //$parametros->xml = $formatoXml;
    $result = $client->validarComprobante($parametros);

    $mensaje = "";
    $estado  = "";

    $estadoComprobante = $result->RespuestaRecepcionComprobante->estado;
    if ($estadoComprobante == "DEVUELTA") {
        $mensaje = $result->RespuestaRecepcionComprobante->comprobantes->comprobante->mensajes->mensaje->tipo;
        $estado  = $estadoComprobante;
    }

    print_r($mensaje);
    echo "<br/>";
    print_r($estado);
    echo "<pre>";
    print_r($result);
    echo "</pre>";

} catch (SoapFault $e) {

    print "ERROR DEL SERVICIO: " . $e->faultcode . "-" . $e->faultstring;
}
