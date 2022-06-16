<?php 
require_once'../../clases/subcategoria.php';
$adchb_data=new subcategoria(); 
?>
<select class="form-control" id="cmb-categoriau" name="categoria">
	<option value="0">Seleccionar</option>
	<?php echo $adchb_data->ListarCategorias(); ?>
</select>