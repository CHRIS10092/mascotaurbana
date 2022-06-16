<?php

require_once "../../clases/nueva_venta.php";
$obj = new nueva_venta();
print_r(json_encode($obj->TraerRuc($_GET['id'])));
/*
if ($_GET['id']) {
echo "registro encontrado";
}else{
echo "registro No encontrado";
}

 */
