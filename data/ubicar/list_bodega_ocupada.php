<?php
require_once '../../clases/ubicar.php';
$adchb_data = new ubicar();
?>
<select style="width: 100%" class="form-control" id="cmb-bodega-ocupada" onchange="ListarMedicamentos()">
	<option value="0">Seleccionar Bodega</option>
	<?php echo $adchb_data->ListarBodegas(); ?>
</select>