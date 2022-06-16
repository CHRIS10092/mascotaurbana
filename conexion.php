<?php




/*$server = "161.97.124.87";
    $db     = "comprase_venta_carros_db";
    $user   = "comprase";
    $clave  = "^[BemXX@S]{m";
    */

$server = "localhost";
$user   = "root";
$clave  = "";

try {
    $conexion = new PDO("mysql:host=$server;dbname=mascotaurbana", $user, $clave);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "conexion exitosa";
} catch (Exception $e) {
    die("Error: " . $e->GetMessage());
} finally { // esto se ejecuta haya o no error
    $conexion = null;
}
