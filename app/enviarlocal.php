<?php
session_start();

require_once "../app/contenido/head.php"?>

<div class="row">

        <label>ESCOGER USUARIO</label>

</div>
<br>
<br>






<?php require_once "../app/contenido/foot.php"?>
<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

/*require_once '../../modelos/ModelFactura.php';
$factura           = new Factura();
$factura->total    = $_POST['total'];
$factura->subtotal = $_POST['subtotal'];
$factura->iva      = $_POST['iva'];
$factura->fecha    = $_POST['fecha'];
$factura->cliente  = $_POST['ruc'];
 */
$mensaje = "hola como estas es una pruena";
require "../app/contenido/librerias/PHPMailer/Exception.php";
require "../app/contenido/librerias/PHPMailer/SMTP.php";
require "../app/contenido/librerias/PHPMailer/PHPMailer.php";

$mail = new PHPMailer(true);

try {

    //Server settings
    $mail->SMTPDebug = 0; // Enable verbose debug output
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true; // Enable SMTP authentication
    $mail->Username   = 'koriche001@gmail.com'; // SMTP username
    $mail->Password   = ''; // SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587; // TCP port to connect to

    //Recipients
    $mail->setFrom('koriche001@gmail.com', 'Milenial');
    $mail->addAddress('koriche001@gmail.com', 'Joe User'); // Add a recipient

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'factura';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

//echo $factura->registrar_factura();

?>
