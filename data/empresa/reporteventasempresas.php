<?php
require_once '../../clases/articulo.php';
$adchb_data = new articulo();
?>
<table id="tbl-articulo" class="table table-striped table-hover">
	<thead>
		<tr class="info">
	<th>NUMERO FACTURA</th>
	<th>NOMBRE CLIENTE</th>
	<th>APELLIDO CLIENTE</th>
	<th>CEDULA</th>
	<th>FECHA</th>
	<th>TOTAL</th>
	<th>ACCIONES</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $adchb_data->repor(); ?>
	</tbody>
</table>
<script type="text/javascript">
	$('#tbl-articulo').DataTable({});
</script>