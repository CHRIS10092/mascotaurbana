<?php 
require_once'../../clases/subcategoria.php';

$adchb_subcategoria=new subcategoria();

echo $adchb_subcategoria->Eliminar($_POST['id']);
