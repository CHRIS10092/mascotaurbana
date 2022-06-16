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
			<th>VALOR PRECIO COMPRA</th>
			<th>STOCK</th>
			<th>VALOR PVP</th>
			<th>IMAGEN</th>
			<th>ACCIONES</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $adchb_data->ListarStock($_SESSION["empresa"]['idempresa']); ?>
	</tbody>
</table>
<script type="text/javascript">
	$('#tbl-articulo').DataTable({});
</script>