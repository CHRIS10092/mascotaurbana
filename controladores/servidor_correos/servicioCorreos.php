<?php
require_once '../../clases/config.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class ServicioCorreos extends config
{

    private $host_correo     = "mail.comprasegura.com.ec";
    private $correo_origen   = "gluzuriaga@comprasegura.com.ec";
    private $password_correo = "-b9V@&RE=GyH";

    private $db;

    public function __construct()
    {

        $this->db = config::Abrir();
    }

    private function servicio($correo_destino, $mensaje_destino)
    {

        $res = false;

        require_once '../../app/PHPMailer/Exception.php';
        require_once '../../app/PHPMailer/PHPMailer.php';
        require_once '../../app/PHPMailer/SMTP.php';

        $mail = new PHPMailer(true);

        try {

            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = $this->host_correo;
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->correo_origen;
            $mail->Password   = $this->password_correo;
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom($this->correo_origen, ' Urbana');
            $mail->addAddress($correo_destino, 'Usuario');

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Here is the subject';
            $mail->Body    = $mensaje_destino;
           
            $mail->send();
            $res = true;
        } catch (Exception $e) {
            //print $e->getMessage();
        }

        return $res;
    }

   

    public function enviar_email($cuenta_correo, $mensaje)
    {

        return self::servicio($cuenta_correo, $mensaje);
    }

    public function verificar_correo($correo)
    {

        $res = false;

        $sql = "SELECT * FROM tbl_usuarios WHERE usu_correo = :correo";

        $ps = $this->db->prepare($sql);
        $ps->execute([
            "correo" => $correo,
        ]);

        if ($ps->rowCount() > 0) {
            $res = true;
        }

        return $res;
    }
}