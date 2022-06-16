<?php 
require_once'../../clases/articulo.php';
$adchb_data=new articulo(); 
?>
<select  class="form-control" id="cmb-categoria" name="categoria" onclick="listar_subcategorias()">
	<option value="0">Seleccionar</option>
	<?php echo $adchb_data->ListarCategoria(); ?>
</select>
