<?php
require_once '../app/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$correo = $_GET['p1'];
$cedula = $_GET['p2'];
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

$html = file_get_contents_curl("http://localhost:80/mascotaurbana/pdf/reporte_informacion.php?correo=" . $correo . "&cedula=" . $cedula);

$pdf = new DOMPDF();

$pdf->set_paper("letter", "portrait");

$pdf->load_html($html, 'UTF-8');

$pdf->render();
$pdf->stream('informacion.pdf', array('Attachment' => 0));
