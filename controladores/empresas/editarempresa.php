<?php
error_reporting(0);
require_once '../../clases/empresas.php';

$adchb_usuario = new empresa();
$imagen        = "";
if ($_FILES["imagen"]["name"] == "") {
    $imagen = $_POST['Foto'];
} else {
    //obtengo el nombre de la imagen
    $foto = ($_FILES["imagen"]["name"]);
    //nombre temporal
    $nombretemp = ($_FILES["imagen"]["tmp_name"]);
    //obtener la carpeta
    $path = "../../imagenes/";
    unlink("../../" . $_POST['Foto']);
    $imagen = "imagenes/" . $foto;
    //guardar img bbdd
    copy($nombretemp, $path . $foto);
}
if ($_FILES["ruta-firmaun"]["name"] == "") {
    $imagen1 = $_POST['ruta-firmaun'];
} else {
    //obtengo el nombre de la imagen
    $foto1 = ($_FILES["ruta-firmaun"]["name"]);
    //nombre temporal
    $nombretemp1 = ($_FILES["ruta-firmaun"]["tmp_name"]);
    //obtener la carpeta
    $path1 = "../../certificados/";
    //unlink("../../" . $_POST['ruta-firmau']);
    $imagen1 = "certificados/" . $foto1;
    //guardar img bbdd
    copy($nombretemp1, $path1 . $foto1);
}

$datos = [
    //id para el where
    $_POST['emp-idu1'],
    $_POST['emp-rucu'],
    $_POST['emp-nombreu'],
    $_POST['emp-direccionu'],
    $_POST['emp-correou'],
    $_POST['emp-telefonou'],
    $imagen,
    $_POST['emp-provinciau'],
    $_POST['emp-cantonu'],
    $_POST['emp-parroquiau'],
    $_POST['emp-calleprincipalu'],
    $_POST['emp-callesecundariau'],
    $_POST['emp-numerooficinau'],
    $_POST['emp-referenciau'],
    //$_POST['emp-estadou'],
    $_POST['emp-tipoempresau'],
    //certificado
    $imagen1,
    $_POST['contrasena-firmau'],
    $_POST['tipoambienteu'],

];
//echo $adchb_usuario->Editar($datos);
print_r($datos);
/* 
$body = "Reciba un saludo cordial de parte de la Empresa Mascota Urbana, la actualización de los datos de su<br>Empresa:" . $_POST['emp-nombreu'] . "<br> Telefono:" . $_POST['emp-telefonou'] . "<br> Direccion:" . $_POST['emp-direccionu'] . "<br> Correo:" . $_POST['emp-correou'] . "<br> Provincia:" . $_POST['emp-provinciau'] . "<br> Canton:" . $_POST['emp-cantonu']
    . "<br> Parroquia:" . $_POST['emp-parroquiau'] . "<br> Calle Principal:" . $_POST['emp-calleprincipalu'] . "<br> Calle Secundaria:" . $_POST['emp-callesecundariau'] . "<br>  Numero de Oficina:" . $_POST['emp-numerooficinau'] . "<br>  Referencia de Casa:" . $_POST['emp-referenciau'] . "<br>Se ha realizado de manera exitosa";

use PHPMailer\PHPMailer\PHPMailer;

require "../../app/contenido/librerias/PHPMailer/Exception.php";
require "../../app/contenido/librerias/PHPMailer/SMTP.php";
require "../../app/contenido/librerias/PHPMailer/PHPMailer.php";

$mail = new PHPMailer(true);

try {

//Server settings
    $mail->SMTPDebug = 0; // Enable verbose debug output
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host       = 'mail.mascotaurbana.club'; // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true; // Enable SMTP authentication
    $mail->Username   = 'correo@mascotaurbana.club'; // SMTP username
    $mail->Password   = 'Correo2021'; // SMTP password
    $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 465; // TCP port to connect to

//Recipients
    $mail->setFrom('correo@mascotaurbana.club', 'Mascota urbana');
    $mail->addAddress('koriche001@gmail.com', 'Christopher'); // Add a recipient

    //$mail->addAddress('girman2004@hotmail.com', 'German'); // Add a recipient

// Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

// Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'datos de prueba';
    $mail->Body    = $body;

    $mail->send();
    //echo 'el message se envio correctamente';
} catch (Exception $e) {
    echo "Messagecouldnotbesent . MailerError:{ $mail->ErrorInfo}";
}

*/