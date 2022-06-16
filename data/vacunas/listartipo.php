<?php
require_once "../../clases/vacunas.php";
$obj = new vacunas();

?>
<select  name="tipovacuna" id="cmb-tipovacuna" class="form-control"  >

<option value="0">--Seleccionar</option>
<?php echo $obj->ListarTipo(); ?>

</select>
