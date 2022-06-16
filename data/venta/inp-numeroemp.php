<?php

require_once '../../clases/nueva_venta.php';
require_once '../../helpers/funciones.php';

$obj = new nueva_venta;

$numero = $obj->NuevoNumeroEMP($_SESSION['empresa']['idempresa']);

$secuencia = secuenciales($numero, 9);

?>

<input type="text" class="form-control" name="numero" id="txt-numero" readonly value="<?php echo $secuencia; ?>">
