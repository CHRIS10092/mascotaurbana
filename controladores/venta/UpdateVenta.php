<?php 


require_once ("../../clases/VentasModel.php");
$obj= new VentasModel();
$obj->UpdateVenta($_POST['estado'],$_POST['detalle'],$_POST['id']);
echo "ok correcto"




 ?>