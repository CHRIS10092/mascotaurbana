<?php 
require_once'../../clases/subcategoria.php';
$adchb_data=new subcategoria(); 
?>
<select style="width: 100%" class="form-control" id="cmb-categoria" name="categoria">
	<option value="0">Seleccionar</option>
	<?php echo $adchb_data->ListarCategorias(); ?>
</select>
<script type="text/javascript">
	$('#cmb-categoria').select2({});
</script>