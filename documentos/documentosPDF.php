<?php
$formatoXml = '<?xml version="1.0" encoding="UTF-8"?>

<factura version="1.0.0" id="comprobante">
    <infoTributaria>
        <ambiente>1</ambiente>
        <tipoEmision>1</tipoEmision>
        <razonSocial>IBC INTERNATIONAL BUSINESS CORPORATION</razonSocial>
        <nombreComercial>IBC INTERNATIONAL BUSINESS CORPORATION</nombreComercial>
        <ruc>1722296686001</ruc>
        <claveAcceso>2806202201172229668600110010010000001461234567818</claveAcceso>
        <codDoc>01</codDoc>
        <estab>001</estab>
        <ptoEmi>001</ptoEmi>
        <secuencial>000000146</secuencial>
        <dirMatriz>-Av. Mariscal Sucre-Sigchos-Jose Iturralde-N123-junto al dispensario de salud  numero 3</dirMatriz>
    </infoTributaria>
    <infoFactura>
        <fechaEmision>28/06/2022</fechaEmision>
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
</factura>';
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once '../app/dompdf/autoload.inc.php';
//require_once '../modelos/ModelConsultas.php';
use Dompdf\Dompdf;
$ruta='../facturasPDF/';
$cod=$_GET['ruc'];
$numero=$_GET['venta'];

require_once "../clases/reporteModel.php";

//print_r($_GET['buscar']);

$obj1       = new ReporteModel();
$pdf1 = $obj1->Correo($cod);
/*$cabecera=datos_ultima_factura($cod);
foreach ($cabecera as $datos) {
	$folio=$datos[0];
}
//print_r($folio);

$correo_dir=obtener_mail($cod);
foreach ($correo_dir as $datos1) {
	$correo=$datos1[0];
}
*/
// Introducimos HTML de prueba
function file_get_contents_curl($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

$html = file_get_contents_curl("http://localhost/mascotaurbana/app/documentopdf.php?ruc=" . $cod . "&&venta=" . $numero);

// Instanciamos un objeto de la clase DOMPDF.
$pdf = new DOMPDF();

// Definimos el tamaño y orientación del papel que queremos.
$pdf->set_paper("letter", "portrait");
//$pdf->set_paper(array(0, 0, 104, 250));
//$pdf->set_paper("a8", "landscape");
// Cargamos el contenido HTML.
$pdf->load_html(utf8_decode($html));

$pdf->set_option('isHtml5ParserEnabled', true);
// Renderizamos el documento PDF.
$pdf->render();
//guardar en servidor local
$output=$pdf->output();
//print_r($output);
$folio="000-0002";

file_put_contents($ruta.'factura-'.$folio.'.pdf',$output);
// Enviamos el fichero PDF al navegador.
//$pdf->stream('factura.pdf');
$pdf->stream('factura-'.$folio.'.pdf');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../app/PHPMailer/Exception.php';
require '../app/PHPMailer/PHPMailer.php';
require '../app/PHPMailer/SMTP.php';
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'koriche001@gmail.com';                     // SMTP username
    $mail->Password   = 'dthxtgyrotydlwrt';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('koriche001@gmail.com', 'Mascota Urbana');
    $mail->addAddress($pdf1->correo, 'Cliente');     // Add a recipient

    // Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'factura';
    $mail->Body    = 'documento de prueba <b>!</b>';
// definiendo el adjunto 
$mail->AddStringAttachment($output, 'factura-'.$folio.'.pdf', 'base64', 'application/pdf');
$mail->AddStringAttachment(''.$formatoXml.'', '000000145.xml', 'base64', 'application/xml');
    $mail->send();
    
    //echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}