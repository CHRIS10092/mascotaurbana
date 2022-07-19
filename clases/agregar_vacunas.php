<?php 
require_once "config.php";
class agregar_vacunas extends config{

private $dbh;
function __construct(){
    $this->dbh=config::Abrir();
}

public function registrar_vacuna($datos){

try{
    
    $sql="INSERT INTO `tbl_mascotas_vacunadas`(`cedula_mascota`, `nombre_mascota`, `fecha_vacuna`, `peso_mascota`) VALUES (:codigo_mascota,_nombre_mascota,:fecha_vacuna,:peso_mascota)";
    $stmt=$this->dbh->prepare($sql);
    $stmt->execute([
    "codigo_mascota"=>$datos[0],
    "nombre_mascota"=>$datos[1],
    "fecha_vacuna"=>$datos[2],
    "peso_mascota"=>$datos[3],
    ]);
    echo 1;
}catch(PDOException $e){
    echo $e->Message();
}

}


public function editar_vacuna(){
    
}
public function eliminar_vacuna(){

}
}
?>