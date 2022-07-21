
<?php
session_start();
print_r($_SESSION);

require_once '../../clases/VentasModel.php';

    class Recepcion{
//AQUI METODO DE LA FIRMA
    //
    // firmar documento
    /**
     * Inject signature
     * @param  string $xml Unsigned XML document
     * @param  array $cer ArchivoCertificado para Firmar XML document
     * @return string      Signed XML document
     */
    public function injectSignature($xml = null, $cer = array())
    {
        // Generate random IDs
        $signatureID                 = $this->randomId();
        $signedInfoID                = $this->randomId();
        $signedPropertiesID          = $this->randomId();
        $signatureValueID            = $this->randomId();
        $certificateID               = $this->randomId();
        $referenceID                 = $this->randomId();
        $signatureSignedPropertiesID = $this->randomId();
        $signatureObjectID           = $this->randomId();
        //guardar firma correct
        //$certPath                    = FCPATH . '/archivos/firma/' . $cer['certificado'];
        $certPath   = $cer['certificado'];
        $passphrase = $cer['clave'];
        if (openssl_pkcs12_read(file_get_contents($certPath), $certs, $passphrase)) {
            $publicKey  = openssl_x509_read($certs['cert']);
            $privateKey = openssl_pkey_get_private($certs['pkey']);
            //print_r($certs);
        }

        // Normalize document
        $xml = str_replace("\r", "", $xml);
        // Prepare signed properties
        $signTime   = time();
        $certData   = openssl_x509_parse($publicKey);
        $certIssuer = array();
        foreach ($certData['issuer'] as $item => $value) {
            $certIssuer[] = $item . '=' . $value;
        }
        $certIssuer = implode(',', $certIssuer);
        //echo $certIssuer;
        // Generate signed properties
        $prop = '<etsi:SignedProperties Id="Signature' . $signatureID .
        '-SignedProperties' . $signatureSignedPropertiesID . '">' .
        '<etsi:SignedSignatureProperties>' .
        '<etsi:SigningTime>' . date('c', $signTime) . '</etsi:SigningTime>' .
        '<etsi:SigningCertificate>' .
        '<etsi:Cert>' .
        '<etsi:CertDigest>' .
        '<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"></ds:DigestMethod>' .
        '<ds:DigestValue>' . $this->getCertDigest($publicKey) . '</ds:DigestValue>' .
            '</etsi:CertDigest>' .
            '<etsi:IssuerSerial>' .
            '<ds:X509IssuerName>' . $certIssuer . '</ds:X509IssuerName>' .
            '<ds:X509SerialNumber>' . $certData['serialNumber'] . '</ds:X509SerialNumber>' .
            '</etsi:IssuerSerial>' .
            '</etsi:Cert>' .
            '</etsi:SigningCertificate>' .
            '</etsi:SignedSignatureProperties>' .
            '<etsi:SignedDataObjectProperties>' .
            '<etsi:DataObjectFormat ObjectReference="#Reference-ID-' . $referenceID . '">' .
            '<etsi:Description>contenido comprobante</etsi:Description>' .
            '<etsi:MimeType>text/xml</etsi:MimeType>' .
            '</etsi:DataObjectFormat>' .
            '</etsi:SignedDataObjectProperties>' .
            '</etsi:SignedProperties>';
        //echo $prop;
        // Extract public exponent (e) and modulus (n)
        $privateData = openssl_pkey_get_details($privateKey);
        $modulus     = chunk_split(base64_encode($privateData['rsa']['n']), 76);
        $modulus     = str_replace("\r", "", $modulus);
        $exponent    = base64_encode($privateData['rsa']['e']);

        // Generate KeyInfo
        $kInfo = '<ds:KeyInfo Id="Certificate' . $certificateID . '">' . "\n" .
        '<ds:X509Data>' . "\n" .
        '<ds:X509Certificate>' . "\n" . $this->getCert($publicKey) . '</ds:X509Certificate>' . "\n" .
            '</ds:X509Data>' . "\n" .
            '<ds:KeyValue>' . "\n" .
            '<ds:RSAKeyValue>' . "\n" .
            '<ds:Modulus>' . "\n" . $modulus . '</ds:Modulus>' . "\n" .
            '<ds:Exponent>' . $exponent . '</ds:Exponent>' . "\n" .
            '</ds:RSAKeyValue>' . "\n" .
            '</ds:KeyValue>' . "\n" .
            '</ds:KeyInfo>';
        //echo $kInfo;
        // Calculate digests
        $xmlns          = 'xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:etsi="http://uri.etsi.org/01903/v1.3.2#"';
        $propDigest     = $this->getDigest(str_replace('<etsi:SignedProperties', '<etsi:SignedProperties ' . $xmlns, $prop));
        $kInfoDigest    = $this->getDigest(str_replace('<ds:KeyInfo', '<ds:KeyInfo ' . $xmlns, $kInfo));
        $documentDigest = $this->getDigest($xml);

        // Generate SignedInfo
        $sInfo = '<ds:SignedInfo Id="Signature-SignedInfo' . $signedInfoID . '">' . "\n" .
            '<ds:CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315">' .
            '</ds:CanonicalizationMethod>' . "\n" .
            '<ds:SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1">' .
            '</ds:SignatureMethod>' . "\n" .
            '<ds:Reference Id="SignedPropertiesID' . $signedPropertiesID . '" ' .
            'Type="http://uri.etsi.org/01903#SignedProperties" ' .
            'URI="#Signature' . $signatureID . '-SignedProperties' .
            $signatureSignedPropertiesID . '">' . "\n" .
            '<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1">' .
            '</ds:DigestMethod>' . "\n" .
            '<ds:DigestValue>' . $propDigest . '</ds:DigestValue>' . "\n" .
            '</ds:Reference>' . "\n" .
            '<ds:Reference URI="#Certificate' . $certificateID . '">' . "\n" .
            '<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1">' .
            '</ds:DigestMethod>' . "\n" .
            '<ds:DigestValue>' . $kInfoDigest . '</ds:DigestValue>' . "\n" .
            '</ds:Reference>' . "\n" .
            '<ds:Reference Id="Reference-ID-' . $referenceID . '" URI="#comprobante">' . "\n" .
            '<ds:Transforms>' . "\n" .
            '<ds:Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature">' .
            '</ds:Transform>' . "\n" .
            '</ds:Transforms>' . "\n" .
            '<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1">' .
            '</ds:DigestMethod>' . "\n" .
            '<ds:DigestValue>' . $documentDigest . '</ds:DigestValue>' . "\n" .
            '</ds:Reference>' . "\n" .
            '</ds:SignedInfo>';
        //echo $sInfo;
        // Calculate signature
        $signatureResult = $this->getSignature(str_replace('<ds:SignedInfo', '<ds:SignedInfo ' . $xmlns, $sInfo), $privateKey);

        // Make signature
        $sig = '<ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:etsi="http://uri.etsi.org/01903/v1.3.2#" Id="Signature' . $signatureID . '">' . "\n" .
            $sInfo . "\n" .
            '<ds:SignatureValue Id="SignatureValue' . $signatureValueID . '">' . "\n" .
            $signatureResult .
            '</ds:SignatureValue>' . "\n" .
            $kInfo . "\n" .
            '<ds:Object Id="Signature' . $signatureID . '-Object' . $signatureObjectID . '">' .
            '<etsi:QualifyingProperties Target="#Signature' . $signatureID . '">' .
            $prop .
            '</etsi:QualifyingProperties>' .
            '</ds:Object>' .
            '</ds:Signature>';
        //echo $sig;
        // Inject signature
        $xml = str_replace('</factura>', $sig . '</factura>', $xml);
        //echo $xml;
        return $xml;
    }

    /**
     * Generate random ID
     *
     * This method is used for generating random IDs required when signing the
     * document.
     *
     * @return int Random number
     */
    public function randomId()
    {
        if (function_exists('random_int')) {
            return random_int(0x10000000, 0x7FFFFFFF);
        }

        return rand(100000, 999999);
    }

    /**
     * Get certificate digest
     * @param  string  $publicKey Public Key
     * @param  boolean $pretty    Pretty Base64 response
     * @return string             Base64 Digest
     */
    public function getCertDigest($publicKey, $pretty = false)
    {
        $digest = openssl_x509_fingerprint($publicKey, "sha1", true);
        return $this->toBase64($digest, $pretty);
    }

    /**
     * To Base64
     * @param  string  $bytes  Input
     * @param  boolean $pretty Pretty Base64 response
     * @return string          Base64 response
     */
    public function toBase64($bytes, $pretty = false)
    {
        $res = base64_encode($bytes);
        return $pretty ? $this->prettify($res) : $res;
    }

    /**
     * Prettify
     * @param  string $input Input string
     * @return string        Multi-line resposne
     */
    public function prettify($input)
    {
        return chunk_split($input, 76, "\n");
    }

    /**
     * Get certificate
     * @param  string  $publicKey Public Key
     * @param  boolean $pretty    Pretty Base64 response
     * @return string             Base64 Certificate
     */
    public function getCert($publicKey, $pretty = true)
    {
        openssl_x509_export($publicKey, $publicPEM);
        $publicPEM = str_replace("-----BEGIN CERTIFICATE-----", "", $publicPEM);
        $publicPEM = str_replace("-----END CERTIFICATE-----", "", $publicPEM);
        $publicPEM = str_replace("\n", "", str_replace("\r", "", $publicPEM));
        if ($pretty) {
            $publicPEM = $this->prettify($publicPEM);
        }

        return $publicPEM;
    }

    /**
     * Get digest
     * @param  string  $input  Input string
     * @param  boolean $pretty Pretty Base64 response
     * @return string          Digest
     */
    public function getDigest($input, $pretty = false)
    {
        return $this->toBase64(sha1($input, true), $pretty);
    }

    /**
     * Get signature
     * @param  string  $payload    Data to sign
     * @param  string  $privateKey Private Key
     * @param  boolean $pretty     Pretty Base64 response
     * @return string              Base64 Signature
     */
    public function getSignature($payload, $privateKey, $pretty = true)
    {
        openssl_sign($payload, $signature, $privateKey);
        return $this->toBase64($signature, $pretty);
    }

    // para llamar desde el controlador de la vista factruras electronicas

}

$obj= new Recepcion();

$formatoXml = $_POST['xml'];
//print_r($formatoXml);
try {
//require_once '../../app/librerias/nusoap/src/nusoap.php';
$url = 'https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantesOffline?wsdl';
$client = new SoapClient($url);

//FIRMA ELECTRONICA//////////////
//AQUI TRAER LOS DATOS DESDE LA BASE 
ini_set('default_socket_timeout', 600);//o el valor que quieras

$venta = new VentasModel();
$valor=$venta->ListarP12($_POST['numero']);
//print_r($valor->certificado);
//print_r($valor->clave);
$factura_xml = trim(str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $formatoXml));

$cert['certificado'] = $valor->certificado;
$cert['clave'] = $valor->clave;
$factura_firmada = $obj->injectSignature(trim($factura_xml), $cert);
$factura_xml_firmada = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . $factura_firmada;
//print_r($factura_xml_firmada);

$parametros = new stdClass();
$parametros->xml = $factura_xml_firmada;
//$parametros->xml = $formatoXml;
$result = $client->validarComprobante($parametros);
//print_r($result);

if($result->RespuestaRecepcionComprobante->estado=='RECIBIDA'){
    $estado="RECIBIDA" ;
    //aqui colocar las sesiones de las empresas
    $venta->XmlFirmado($_POST['numero'],$factura_xml_firmada,$estado,$valor->empresa,$valor->sucursal);
    
}


$estadoComprobante = $result->RespuestaRecepcionComprobante->estado;

print_r(json_encode($result));
/*if ($estadoComprobante == "DEVUELTA") {

$datos = [

$mensaje = $result->RespuestaRecepcionComprobante->comprobantes->comprobante->mensajes->mensaje->tipo,
$mensaje1 = $result->RespuestaRecepcionComprobante->comprobantes->comprobante->mensajes->mensaje->mensaje,
$tipoerror = $result->RespuestaRecepcionComprobante->comprobantes->comprobante->mensajes->mensaje->informacionAdicional,
$estado = $estadoComprobante,

];
//print($datos[2]);
//$obj->Registrar_Respuestas($datos[0], $datos[1], $datos[2]);
}else if($estadoComprobante == "RECIBIDA"){
    
    //aqui enviarle el xml firmada el update con el numero de venta a la tabla tbl_ventas para hacer el segundo paso de autorizar
    //con el numero de venta el idsucursal y el idempresa
    $venta = new VentasModel;
       
    $estado='3';
    $venta->XmlFirmado($_POST['numero'],$factura_xml_firmada,$estado,'4','1');
    
       
}else{



//print_r($mensaje);
echo "<br />";
//print_r($estado);
echo "
<pre>";
  //print_r($result);
    echo "</pre>";
}
*/
} catch (SoapFault $e) {

print "ERROR DEL SERVICIO: " . $e->faultcode . "-" . $e->faultstring;
}


?>