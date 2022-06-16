<select class="form-control" id="cmb-subcategoria" name="subcategoria">
	<option value="0">Seleccionar</option>
	<?php
if (isset($_POST['id'])) {
    require_once '../../clases/articulo.php';
    $adchb_data = new articulo();
    echo $adchb_data->ListarSubcategoria($_POST['id']);
}
?>
</select>