<?php 

//echo 'datos';
//print_r($_POST);
require_once "../../clases/vacunas.php";
$obj= new vacunas();
$datos =[

$_POST['id_mascota'],
$_POST['nombre_mascota'],
$_POST['fecha'],
$_POST['tipovacuna'],    
$_POST['peso'],
];
echo $obj->AddInsertar($datos);
?>