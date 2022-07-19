<?php
require_once "../../clases/vacunas.php";
$obj = new vacunas();

?>
<select  name="tipovacuna" id="cmb-tipovacuna" class="form-control col-md-5"  >

<option value="0">--Seleccionar</option>
<?php echo $obj->ListarTipoVacunas(); ?>

</select>
<script type="text/javascript">
$('#cmb-tipovacuna').select2();

    
</script>
