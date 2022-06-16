<?php
require_once '../../clases/chips.php';
$adchb_data = new chips();
?>
<table id="tbl-articulo" class="table table-striped table-hover">
	<thead>
		<tr class="info">
			<th>CODIGO</th>
			<th>NUMERO</th>
            <th>ESTADO</th>
			<th>IDEMPRESA</th>
			<th>IDSUCURSAL</th>
			
		</tr>
	</thead>
	<tbody>
		<?php echo $adchb_data->Listar(); ?>
	</tbody>
</table>
<script type="text/javascript">
	$('#tbl-articulo').DataTable({});
</script>