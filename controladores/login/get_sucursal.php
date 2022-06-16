<?php
require_once '../../clases/login.php';
$obj = new Login;
$obj->get_sucursal($_POST);
