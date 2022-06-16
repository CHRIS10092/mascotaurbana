<?php 

require_once ("../../clases/usuario.php");
$obj=new usuario();
//$obj->Tr


$id=$_POST['id-usuario'];

//verifico si hay usuario 
if ($obj->VerificarPermiso($id)>0) {

	//ingreso los parametros para registrar al modelo
	$datos=[$_POST['sub_categoria'],$_POST['id-usuario']];
//ejecuto el actualizar permiso
//$obj->Actualizar_Permiso($datos);

print_r($obj->Actualizar_Permiso($datos));

}else{

$datos=[$_POST['sub_categoria'],$_POST['id-usuario']];
//ejecuto el actualizar permiso

//$obj->Registrar_Permiso($datos);

	print_r($obj->Registrar_Permiso($datos));

	

}

 ?>