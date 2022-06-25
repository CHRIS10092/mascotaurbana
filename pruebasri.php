<?php
$formatoXml = '<?xml version="1.0" encoding="UTF-8"?>

<factura version="1.0.0" id="comprobante">
    <infoTributaria>
        <ambiente>1</ambiente>
        <tipoEmision>1</tipoEmision>
        <razonSocial>IBC INTERNATIONAL BUSINESS CORPORATION</razonSocial>
        <nombreComercial>IBC INTERNATIONAL BUSINESS CORPORATION</nombreComercial>
        <ruc>1722296686001</ruc>
        <claveAcceso>2406202201172229668600110010010000000961234567819</claveAcceso>
        <codDoc>01</codDoc>
        <estab>001</estab>
        <ptoEmi>001</ptoEmi>
        <secuencial>000000096</secuencial>
        <dirMatriz>-Av. Mariscal Sucre-Sigchos-Jose Iturralde-N123-junto al dispensario de salud  numero 3</dirMatriz>
    </infoTributaria>
    <infoFactura>
        <fechaEmision>24/06/2022</fechaEmision>
        <obligadoContabilidad>NO</obligadoContabilidad>
        <tipoIdentificacionComprador>04</tipoIdentificacionComprador>
        <razonSocialComprador>Chris Chris</razonSocialComprador>
        <identificacionComprador>1724024177</identificacionComprador>
        <direccionComprador>Pruebas Dir</direccionComprador>
        <totalSinImpuestos>1.12</totalSinImpuestos>
        <totalDescuento>0.00</totalDescuento>
        <totalConImpuestos>
            <totalImpuesto>
                <codigo>2</codigo>
                <codigoPorcentaje>2</codigoPorcentaje>
                <descuentoAdicional>0.00</descuentoAdicional>
                <baseImponible>1.00</baseImponible>
                <tarifa>12.00</tarifa>
                <valor>0.12</valor>
            </totalImpuesto>
        </totalConImpuestos>
        <propina>0.00</propina>
        <importeTotal>1.12</importeTotal>
        <moneda>DOLAR</moneda>
        <pagos>
            <pago>
                <formaPago>01</formaPago>
                <total>1.12</total>
            </pago>
        </pagos>
    </infoFactura>
    <detalles><detalle>

        <codigoPrincipal>32</codigoPrincipal>
        <codigoAuxiliar>32</codigoAuxiliar>
        <descripcion>MICROCHIPS ..</descripcion>
        <cantidad>1</cantidad>
        <precioUnitario>1.00</precioUnitario>
        <descuento>0</descuento>
        <precioTotalSinImpuesto>1.00</precioTotalSinImpuesto><impuestos>
                <impuesto>
                    <codigo>2</codigo>
                    <codigoPorcentaje>2</codigoPorcentaje>
                    <tarifa>12.00</tarifa>
                    <baseImponible>1.00</baseImponible>
                    <valor>0.12</valor>
                </impuesto>
            </impuestos>
        </detalle></detalles>
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
