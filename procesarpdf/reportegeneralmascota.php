<?php
require_once '../app/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$buscar = $_GET['id'];
$ced    = $_GET['tenedor'];
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

$html = file_get_contents_curl("http://localhost:80/mascotaurbana/pdf/reportegmascota.php?buscar=" . $buscar . "&&tenedor=" . $ced);

$pdf = new DOMPDF();

$pdf->set_paper("letter", "portrait");

$pdf->load_html($html, 'UTF-8');

$pdf->render();
$pdf->stream('reporte.pdf', array('Attachment' => 0));
