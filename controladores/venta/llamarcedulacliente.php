<?php 


require_once ("../../clases/nueva_venta.php");
$obj= new nueva_venta();
print_r(json_encode($obj->TraerCedulasV($_GET['id'])));




 ?>