<?php
session_start();
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once '../../app/dompdf/autoload.inc.php';
require_once '../../clases/pdfsri.php';
$datos = new PdfSri();
$formatoXml=$_POST['xml'];
use Dompdf\Dompdf;
$ruta='../../facturasPDF/';
$cod=$_POST['numero'];
$idempresa=$_SESSION['empresa']['idempresa'];
$idsucursal=$_SESSION['sucursal']['codigo'];
$cabecera=$datos->datos_factura($cod,$idempresa,$idsucursal);
$folio=$cabecera->numero;
//print_r($cabecera->numero);

$correo_dir=$datos->obtener_mail($_POST['numero'],$_POST['correo']);
$correo=$correo_dir->correo;
//print_r($correo_dir->correo);
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

$html = file_get_contents_curl("https://www.comprasegura.com.ec/mascotaurbana/app/documentopdf.php?ruc=".$cod);

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
file_put_contents($ruta.'factura-'.$folio.'.pdf',$output);
// Enviamos el fichero PDF al navegador.
//$pdf->stream('factura.pdf');
$pdf->stream('factura-'.$folio.'.pdf');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../app/PHPMailer/Exception.php';
require '../../app/PHPMailer/PHPMailer.php';
require '../../app/PHPMailer/SMTP.php';
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'mail.comprasegura.com.ec';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'gluzuriaga@comprasegura.com.ec';                     // SMTP username
    $mail->Password   = '-b9V@&RE=GyH';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('gluzuriaga@comprasegura.com.ec', 'Mascota Urbana');
    $mail->addAddress($correo, 'Cliente');     // Add a recipient

    // Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'factura';
    $mail->Body    = 'documento de prueba <b>!</b>';
// definiendo el adjunto 
$mail->AddStringAttachment($output, 'factura-'.$folio.'.pdf', 'base64', 'application/pdf');
$mail->AddStringAttachment(''.$formatoXml.'', 'formato.xml', 'base64', 'application/xml');
    $mail->send();
    
    //echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>