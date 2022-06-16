<?php require_once("../../clases/usuario.php");
$obj= new usuario();

$datos=[
$_POST['id_usuario'],
$_POST['id_empresa'],



];



$ver=$obj->verificarusuarios($_POST['id_usuario']);

if($ver){

echo $obj->ActualizarPer($datos);
 
}else {
echo $obj->GuardarPer($datos);
 }

//print_r($datos);

?>