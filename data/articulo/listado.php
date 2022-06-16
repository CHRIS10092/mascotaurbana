<?php
require_once '../../clases/articulo.php';
$adchb_data = new articulo();
?>
<table id="tbl-articulo" class="table table-striped table-hover">
	<thead>
		<tr class="info">
			<th>CODIGO</th>
			<th>NOMBRE</th>
			<th>DESCRIPCION</th>
			<th>STOCK</th>
			<th>VALOR</th>
			<th>PVP</th>
			<th>CATEGORIA</th>
			<th>SUBCATEGORIA</th>
			<th>IMAGEN</th>
			<th>ACCIONES</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $adchb_data->Listar(); ?>
	</tbody>
</table>
<script type="text/javascript">
	$('#tbl-articulo').DataTable({});
</script>