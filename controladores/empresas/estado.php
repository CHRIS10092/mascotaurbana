
<?php
require_once '../../clases/empresas.php';

$adchb_usuario = new empresa();

echo $adchb_usuario->Estadoempresa($_POST['emp-estadou'], $_POST['emp-idu']);

?>