<?php 
require_once'../../clases/bodega.php';
$adchb_data=new bodega(); 
?>
<table id="tbl-bodega" class="table table-striped table-hover">
	<thead>
		<tr class="info">
			<th>BODEGA</th>
			<th>ACCIONES</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $adchb_data->Listar(); ?>
	</tbody>
</table>
<script type="text/javascript">
	$('#tbl-bodega').DataTable({});
</script>