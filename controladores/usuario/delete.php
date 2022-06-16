<?php 
require_once'../../clases/usuario.php';

$adchb_usuario=new usuario();

echo $adchb_usuario->Eliminar($_POST['id']);

 ?>