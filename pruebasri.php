<?php
$formatoXml = '<?xml version="1.0" encoding="UTF-8"?>
<factura version="1.0.0" id="comprobante">
            <infoTributaria>
                <ambiente>1</ambiente>
                <tipoEmision>1</tipoEmision>
                <razonSocial>IBC INTERNATIONAL BUSINESS CORPORATION</razonSocial>
                <nombreComercial>IBC INTERNATIONAL BUSINESS CORPORATION</nombreComercial>
                <ruc>1722296686001</ruc>
                <claveAcceso>2706202201172229668600110010010000001391234567815</claveAcceso>
                <codDoc>01</codDoc>
                <estab>001</estab>
                <ptoEmi>001</ptoEmi>
                <secuencial>000000139</secuencial>
                <dirMatriz>-Av. Mariscal Sucre-Sigchos-Jose Iturralde-N123-junto al dispensario de salud  numero 3</dirMatriz>
            </infoTributaria>
            <infoFactura>
                <fechaEmision>27/06/2022</fechaEmision>
                <obligadoContabilidad>NO</obligadoContabilidad>
                <tipoIdentificacionComprador>04</tipoIdentificacionComprador>
                <razonSocialComprador>Fausto Coronado</razonSocialComprador>
                <identificacionComprador>0501458426</identificacionComprador>
                <direccionComprador>Ferroviaria</direccionComprador>
                <totalSinImpuestos>12.00</totalSinImpuestos>
                <totalDescuento>0.00</totalDescuento>
                <totalConImpuestos>
                    <totalImpuesto>
                        <codigo>2</codigo>
                        <codigoPorcentaje>2</codigoPorcentaje>
                        <descuentoAdicional>0.00</descuentoAdicional>
                        <baseImponible>10.71</baseImponible>
                        <tarifa>12.00</tarifa>
                        <valor>1.29</valor>
                    </totalImpuesto>
                </totalConImpuestos>
                <propina>0.00</propina>
                <importeTotal>12.00</importeTotal>
                <moneda>DOLAR</moneda>
                <pagos>
                    <pago>
                        <formaPago>01</formaPago>
                        <total>12.00</total>
                    </pago>
                </pagos>
            </infoFactura>
            <detalles><detalle>
        
                <codigoPrincipal>1</codigoPrincipal>
                <codigoAuxiliar>1</codigoAuxiliar>
                <descripcion>Synulox Antibiotico por c 10Tabletas 250gr</descripcion>
                <cantidad>1</cantidad>
                <precioUnitario>10.71</precioUnitario>
                <descuento>0</descuento>
                <precioTotalSinImpuesto>10.71</precioTotalSinImpuesto><impuestos>
                        <impuesto>
                            <codigo>2</codigo>
                            <codigoPorcentaje>2</codigoPorcentaje>
                            <tarifa>12.00</tarifa>
                            <baseImponible>10.71</baseImponible>
                            <valor>1.29</valor>
                        </impuesto>
                    </impuestos>
                </detalle></detalles>
            <infoAdicional>
                <campoAdicional nombre="DIRECCION">CDLA IBARRA 000</campoAdicional>
                <campoAdicional nombre="AgentedeRetención">No.Resolución: 1</campoAdicional>
            </infoAdicional>
        <ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:etsi="http://uri.etsi.org/01903/v1.3.2#" Id="Signature1404435768">
<ds:SignedInfo Id="Signature-SignedInfo1832951131">
<ds:CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"></ds:CanonicalizationMethod>
<ds:SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1"></ds:SignatureMethod>
<ds:Reference Id="SignedPropertiesID766772556" Type="http://uri.etsi.org/01903#SignedProperties" URI="#Signature1404435768-SignedProperties1065098218">
<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"></ds:DigestMethod>
<ds:DigestValue>9wPXFvNfUg6Qc3tzgK9IHv0OOQ8=</ds:DigestValue>
</ds:Reference>
<ds:Reference URI="#Certificate1473187266">
<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"></ds:DigestMethod>
<ds:DigestValue>2PHbLdmMEsELm63OGZGYGGapPMw=</ds:DigestValue>
</ds:Reference>
<ds:Reference Id="Reference-ID-456939924" URI="#comprobante">
<ds:Transforms>
<ds:Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"></ds:Transform>
</ds:Transforms>
<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"></ds:DigestMethod>
<ds:DigestValue>Zq+wDUuQHeXSHv/d/Lf7LBU9c4Q=</ds:DigestValue>
</ds:Reference>
</ds:SignedInfo>
<ds:SignatureValue Id="SignatureValue1417196055">
UQT02h9zBJw4iBuUb6IbAYUN1lhu85EIt7q831Ra2lb3CVoHCB5Ccj0Ju08nbr60T5EUMavCTtIk
zPj/usPMkO+a31RuhOGakySGdmkdCFNdPpB7Y6NQ6GzRDtuBlfz90SuXhpuY5ylHMjeOl2x1DFC8
eGbg+bOhP1GrJUa5UOw4MdH+wFvKPaQiA9y6TYw02o+UlLAprsovKa8vG9w5jDkT89bChWo7JP/G
n18+rZ/+D0V7BIECgepTs0B63nCE49LopgFJ7BALpR5G/rp4Jc+CK8mdUYW0S4Ta1fJ0Df95k3Mc
LZYDisQLV0RJzM1AZ2XHbypTz+n6fEGkoHUdTg==
</ds:SignatureValue>
<ds:KeyInfo Id="Certificate1473187266">
<ds:X509Data>
<ds:X509Certificate>
MIILyzCCCbOgAwIBAgIEE+C4BjANBgkqhkiG9w0BAQsFADCBmTELMAkGA1UEBhMCRUMxHTAbBgNV
BAoMFFNFQ1VSSVRZIERBVEEgUy5BLiAyMTAwLgYDVQQLDCdFTlRJREFEIERFIENFUlRJRklDQUNJ
T04gREUgSU5GT1JNQUNJT04xOTA3BgNVBAMMMEFVVE9SSURBRCBERSBDRVJUSUZJQ0FDSU9OIFNV
QkNBLTIgU0VDVVJJVFkgREFUQTAeFw0yMTA2MDQwMTQzMzBaFw0yNDA2MDMwMTQzMzBaMIGcMSUw
IwYDVQQDDBxOQVRBTFkgTUlTSEVMIENBUlJFUkEgWlVOSUdBMRUwEwYDVQQFEwwwMzA2MjEyMDUz
NDAxMDAuBgNVBAsMJ0VOVElEQUQgREUgQ0VSVElGSUNBQ0lPTiBERSBJTkZPUk1BQ0lPTjEdMBsG
A1UECgwUU0VDVVJJVFkgREFUQSBTLkEuIDIxCzAJBgNVBAYTAkVDMIIBIjANBgkqhkiG9w0BAQEF
AAOCAQ8AMIIBCgKCAQEAis2GGh5X9KdSZmMBsQgrVzybq14whfbejrIcQ0PzIVSmdw7gueUBmjWC
s+ikgq0qIQz0JDEGX0lBjaSOpFMHutNHrg98yZAZObmvHULBwjwhK2k5YWoRkx2zOO8F3WAEfFQ2
B3JQ34vEsxTKLnnHV5Bjr9/2dBig9plyo42LV2wWuOaisqSr27yLc/HYUrdKflkYdkahCIgfZfZ8
dKMoKa1nij63QuTaoZ9/i6VcKePCQkwD7ytYBYQejtaD3x6rHYvKFj+DeX8UeyJJFq4yW66l9Kta
A2tQSlMkGKjYqCZW74AQzBNvUr/sgVEzT7p27TYb9uoVINT4DgrIGuZRMwIDAQABo4IHFDCCBxAw
DAYDVR0TAQH/BAIwADAfBgNVHSMEGDAWgBSMusoRV3glgB1rCktVv42uYt29jzBZBggrBgEFBQcB
AQRNMEswSQYIKwYBBQUHMAGGPWh0dHA6Ly9vY3NwZ3cuc2VjdXJpdHlkYXRhLm5ldC5lYy9lamJj
YS9wdWJsaWN3ZWIvc3RhdHVzL29jc3Awgc8GA1UdLgSBxzCBxDCBwaCBvqCBu4aBuGxkYXA6Ly9s
ZGFwc2RjYTIuc2VjdXJpdHlkYXRhLm5ldC5lYy9DTj1BVVRPUklEQUQgREUgQ0VSVElGSUNBQ0lP
TiBTVUJDQS0yIFNFQ1VSSVRZIERBVEEsT1U9RU5USURBRCBERSBDRVJUSUZJQ0FDSU9OIERFIElO
Rk9STUFDSU9OLE89U0VDVVJJVFkgREFUQSBTLkEuIDIsQz1FQz9kZWx0YVJldm9jYXRpb25MaXN0
P2Jhc2UwHwYDVR0RBBgwFoEUbi5taXNoZWxAaG90bWFpbC5jb20wggEGBgNVHSAEgf4wgfswWgYK
KwYBBAGCpnICBzBMMEoGCCsGAQUFBwICMD4ePABDAGUAcgB0AGkAZgBpAGMAYQBkAG8AIABkAGUA
IABQAGUAcgBzAG8AbgBhACAATgBhAHQAdQByAGEAbDCBnAYKKwYBBAGCpnICATCBjTCBigYIKwYB
BQUHAgEWfmh0dHBzOi8vd3d3LnNlY3VyaXR5ZGF0YS5uZXQuZWMvd3AtY29udGVudC9kb3dubG9h
ZHMvTm9ybWF0aXZhcy9QX2RlX0NlcnRpZmljYWRvcy9Qb2xpdGljYXMgZGUgQ2VydGlmaWNhZG8g
UGVyc29uYSBOYXR1cmFsLnBkZjCCAqIGA1UdHwSCApkwggKVMIHloEGgP4Y9aHR0cDovL29jc3Bn
dy5zZWN1cml0eWRhdGEubmV0LmVjL2VqYmNhL3B1YmxpY3dlYi9zdGF0dXMvb2NzcKKBn6SBnDCB
mTE5MDcGA1UEAwwwQVVUT1JJREFEIERFIENFUlRJRklDQUNJT04gU1VCQ0EtMiBTRUNVUklUWSBE
QVRBMTAwLgYDVQQLDCdFTlRJREFEIERFIENFUlRJRklDQUNJT04gREUgSU5GT1JNQUNJT04xHTAb
BgNVBAoMFFNFQ1VSSVRZIERBVEEgUy5BLiAyMQswCQYDVQQGEwJFQzCBx6CBxKCBwYaBvmxkYXA6
Ly9sZGFwc2RjYTIuc2VjdXJpdHlkYXRhLm5ldC5lYy9DTj1BVVRPUklEQUQgREUgQ0VSVElGSUNB
Q0lPTiBTVUJDQS0yIFNFQ1VSSVRZIERBVEEsT1U9RU5USURBRCBERSBDRVJUSUZJQ0FDSU9OIERF
IElORk9STUFDSU9OLE89U0VDVVJJVFkgREFUQSBTLkEuIDIsQz1FQz9jZXJ0aWZpY2F0ZVJldm9j
YXRpb25MaXN0P2Jhc2UwgeCggd2ggdqGgddodHRwczovL3BvcnRhbC1vcGVyYWRvcjIuc2VjdXJp
dHlkYXRhLm5ldC5lYy9lamJjYS9wdWJsaWN3ZWIvd2ViZGlzdC9jZXJ0ZGlzdD9jbWQ9Y3JsJmlz
c3Vlcj1DTj1BVVRPUklEQUQgREUgQ0VSVElGSUNBQ0lPTiBTVUJDQS0yIFNFQ1VSSVRZIERBVEEs
T1U9RU5USURBRCBERSBDRVJUSUZJQ0FDSU9OIERFIElORk9STUFDSU9OLE89U0VDVVJJVFkgREFU
QSBTLkEuIDIsQz1FQzAdBgNVHQ4EFgQUzsdBWOAOvQ+EYWqLbzbcCho74AowKwYDVR0QBCQwIoAP
MjAyMTA2MDQwMTQzMzBagQ8yMDI0MDYwMzAxNDMzMFowCwYDVR0PBAQDAgXgMBoGCisGAQQBgqZy
AwEEDAwKMTcyMjI5NjY4NjAaBgorBgEEAYKmcgMJBAwMClJVTUlOSUFIVUkwEQYKKwYBBAGCpnID
IgQDDAEuMCgGCisGAQQBgqZyAwcEGgwYUElRVUVST1MgNDMgWSBNSVJBU0lFUlJBMB0GCisGAQQB
gqZyAwIEDwwNTkFUQUxZIE1JU0hFTDAfBgorBgEEAYKmcgMgBBEMDzAwMjAwMTAwMDIwMDYxODAR
BgorBgEEAYKmcgMjBAMMAS4wEwYKKwYBBAGCpnIDIQQFDANQRlgwFwYKKwYBBAGCpnIDDAQJDAdF
Q1VBRE9SMBcGCisGAQQBgqZyAwMECQwHQ0FSUkVSQTARBgorBgEEAYKmcgMeBAMMAS4wHQYKKwYB
BAGCpnIDCwQPDA0xNzIyMjk2Njg2MDAxMBEGCisGAQQBgqZyAx0EAwwBLjAWBgorBgEEAYKmcgME
BAgMBlpVTklHQTAcBgorBgEEAYKmcgMIBA4MDDU5Mzk4Mzg1MjQ1NjANBgkqhkiG9w0BAQsFAAOC
AgEANl47wcCVDVXMV20ykzzP+dj49cYGgEzNgTwrAsl9LZHOzXqe8LsXlJHDN8pfnYZVFQ1EqUsS
BjiHgYvEtoXqdHISYq6i/ZHttZx66heNTovpmdsKxXcFJWfh4su0b8Vq1aZgo4evYMBM5IWfrMW8
4vkwWS3Yln/lQPqo8oh2HVDlwfVAd7goz42k5HK06d7IBhkfKpOaomjgUqjODvTuvIX/tFNreTq0
x+ZsDCN+8kl1dHiJKg/ukih9WUUghmRW7jUykCRhdphw41sR/YDugUXrcAEa4okUZQS5CrsCJxsP
OeNJIEj0aES7iyUuWbLx0ox1BkkhBRi4bbyAkE2V6vQJ3Tm7etW/BuMCKT6rg6WcWPMARmxpoHnG
vDDasBNPDfT9xRB9v8TYVGbiv9Wot9cowSA0s8l7Z0oNb7FZwAn7r/MCcFTBI8VwFRazvfnA9mef
MLlLQsv0mcj8CNXamMnIFkMRRaIeTXUO1LytPbHPZ4fNNTRlytiZTCJLs6WlG/mo+KsC9EM/uClQ
kU2yk8XDdjPtULYxLuxQyN4Z4ZxJikBPmMGNUJqbQ155/VEyDBNzVnKFDkmIH03xm2TFWXQWGbcQ
6/SBVvPzupKuTeiiGDrqlzATrj1mM3iJPHws8TDf/VBCdzf9JsCxylHXlBbITSEfvOs2oJT7/a5P
aW8=
</ds:X509Certificate>
</ds:X509Data>
<ds:KeyValue>
<ds:RSAKeyValue>
<ds:Modulus>
is2GGh5X9KdSZmMBsQgrVzybq14whfbejrIcQ0PzIVSmdw7gueUBmjWCs+ikgq0qIQz0JDEGX0lB
jaSOpFMHutNHrg98yZAZObmvHULBwjwhK2k5YWoRkx2zOO8F3WAEfFQ2B3JQ34vEsxTKLnnHV5Bj
r9/2dBig9plyo42LV2wWuOaisqSr27yLc/HYUrdKflkYdkahCIgfZfZ8dKMoKa1nij63QuTaoZ9/
i6VcKePCQkwD7ytYBYQejtaD3x6rHYvKFj+DeX8UeyJJFq4yW66l9KtaA2tQSlMkGKjYqCZW74AQ
zBNvUr/sgVEzT7p27TYb9uoVINT4DgrIGuZRMw==
</ds:Modulus>
<ds:Exponent>AQAB</ds:Exponent>
</ds:RSAKeyValue>
</ds:KeyValue>
</ds:KeyInfo>
<ds:Object Id="Signature1404435768-Object2019090233"><etsi:QualifyingProperties Target="#Signature1404435768"><etsi:SignedProperties Id="Signature1404435768-SignedProperties1065098218"><etsi:SignedSignatureProperties><etsi:SigningTime>2022-06-27T14:33:06-05:00</etsi:SigningTime><etsi:SigningCertificate><etsi:Cert><etsi:CertDigest><ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"></ds:DigestMethod><ds:DigestValue>lXb2NVKj7r7K/mQn86Ur57Ca8IY=</ds:DigestValue></etsi:CertDigest><etsi:IssuerSerial><ds:X509IssuerName>C=EC,O=SECURITY DATA S.A. 2,OU=ENTIDAD DE CERTIFICACION DE INFORMACION,CN=AUTORIDAD DE CERTIFICACION SUBCA-2 SECURITY DATA</ds:X509IssuerName><ds:X509SerialNumber>333494278</ds:X509SerialNumber></etsi:IssuerSerial></etsi:Cert></etsi:SigningCertificate></etsi:SignedSignatureProperties><etsi:SignedDataObjectProperties><etsi:DataObjectFormat ObjectReference="#Reference-ID-456939924"><etsi:Description>contenido comprobante</etsi:Description><etsi:MimeType>text/xml</etsi:MimeType></etsi:DataObjectFormat></etsi:SignedDataObjectProperties></etsi:SignedProperties></etsi:QualifyingProperties></ds:Object></ds:Signature></factura>';
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
