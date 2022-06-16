<?php
require_once '../../clases/empresas.php';
require_once '../../helpers/funciones.php';

$adchb_data = new empresa();

$numero = $adchb_data->NuevoNumero();

$secuencia = secuenciales($numero, 5);
?>
<input type="text"  class="form-control input-sm" name="emp-id" id="txt-emp-id" readonly value="<?php echo $secuencia; ?>">