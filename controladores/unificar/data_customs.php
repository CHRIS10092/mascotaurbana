<?php
require_once "../../clases/cliente.php";

$obj     = new cliente;
$success = false;
$cliente = "";

if ($obj->search_cliente($_POST['cedula'])) {
    $success = true;
    $cliente = $obj->get_cliente($_POST['cedula']);
}
$dto          = new stdClass();
$dto->success = $success;
$dto->cliente = $cliente;
print_r(json_encode($dto));
