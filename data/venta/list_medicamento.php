<?php
session_start();
require_once '../../clases/nueva_venta.php';
$adchb_data = new nueva_venta();
?><div class="table-responsive">
<table id="tbl-articulo" class="table table-responsive table-hover">
	<thead>
		<tr class="info">
			<th>CODIGO</th>
			<th>NOMBRE</th>
			<th>DESCRIPCION</th>
			<th>CANTIDAD</th>
			<th>COSTO</th>
			<th>EXISTENCIA</th>
			<th>ACCION</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $adchb_data->ListarArticulos($_SESSION["empresa"]['idempresa']); ?>
	</tbody>
</table>
</div>
<script type="text/javascript">
	$('#tbl-articulo').DataTable({});
</script>