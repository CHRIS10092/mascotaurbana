<?php
require_once '../../clases/sucursales.php';
$obj = new sucursal();
?>

<input type="text" readonly="" name="numero" id="txt-numero" value="<?php echo $obj->NuevoNumero(); ?>"	>