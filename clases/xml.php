
<?php
$xml_texto = '<?xml version="1.0" encoding="UTF-8"?>
<?xml version="1.0" encoding="UTF-8"?>

<factura id="comprobante" version="1.0.0">
  <infoTributaria>
    <ambiente>1</ambiente>
    <tipoEmision>1</tipoEmision>
    <razonSocial>Veterinaria Norte</razonSocial>
    <nombreComercial>Veterinaria Norte</nombreComercial>
    <ruc>1722296686001</ruc>
    <claveAcceso>0709202101172527358300110010010000000181234567811</claveAcceso>
    <codDoc>01</codDoc>
    <estab>001</estab>
    <ptoEmi>001</ptoEmi>
    <secuencial>000000018</secuencial>
    <dirMatriz>-Av. Mariscal Sucre-Sigchos-Jose Iturralde-N123-junto al dispensario de salud  numero 3</dirMatriz>
  </infoTributaria>
  <infoFactura>
    <fechaEmision>30/08/2021</fechaEmision>
<obligadoContabilidad>SI</obligadoContabilidad>
<tipoIdentificacionComprador>05</tipoIdentificacionComprador>
<razonSocialComprador>CESAR AUGUSTO FERNANDEZ CUENCA</razonSocialComprador>
<identificacionComprador>1718629445</identificacionComprador>
<direccionComprador>CDLA IBARRA 000</direccionComprador>
<totalSinImpuestos>10.00</totalSinImpuestos>
<totalDescuento>0.00</totalDescuento>
<totalConImpuestos>
<totalImpuesto>
<codigo>2</codigo>
<codigoPorcentaje>2</codigoPorcentaje>
<descuentoAdicional>0.00</descuentoAdicional>
<baseImponible>10.00</baseImponible>
<tarifa>12.00</tarifa>
<valor>1.20</valor>
</totalImpuesto>
</totalConImpuestos>
<propina>0.00</propina>
<importeTotal>11.20</importeTotal>
<moneda>DOLAR</moneda>
<pagos>
<pago>
<formaPago>01</formaPago>
<total>11.20</total>
</pago>
</pagos>
</infoFactura>
<detalles>
<detalle>
<codigoPrincipal>35</codigoPrincipal>
<codigoAuxiliar>35</codigoAuxiliar>
<descripcion>CAMISETA</descripcion>
<cantidad>1</cantidad>
<precioUnitario>10.00</precioUnitario>
<descuento>0</descuento>
<precioTotalSinImpuesto>10.00</precioTotalSinImpuesto>
<impuestos>
<impuesto>
<codigo>2</codigo>
<codigoPorcentaje>2</codigoPorcentaje>
<tarifa>12.00</tarifa>
<baseImponible>10.00</baseImponible>
<valor>1.20</valor>
</impuesto>
</impuestos>
</detalle>
</detalles>
<infoAdicional>
<campoAdicional nombre="DIRECCION">CDLA IBARRA 000</campoAdicional>
<campoAdicional nombre="AgentedeRetención">No.Resolución: 1</campoAdicional>
</infoAdicional>
</factura>';
$url = 'https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantesOffline?wsdl';
$xml = new stdClass();
$xml->xml=$xml_texto;
$client = new SoapClient($url);
$result = $client->validarComprobante($xml);//ACCEDER A LA FUNCION DEL WEB SERVICES
print_r($result);

} catch (SoapFault $e) {
echo $e->getMessage();
}
