<?php 
require_once'../../clases/categoria.php';

$adchb_categoria=new categoria();

echo $adchb_categoria->Eliminar($_POST['id']);

 ?>