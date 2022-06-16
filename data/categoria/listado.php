<?php 
require_once'../../clases/categoria.php';
$adchb_data=new categoria(); 
?>
<table id="tbl-categoria" class="table table-striped table-hover">
	<thead>
		<tr class="info">
			<th>CATEGORIA</th>
			<th>ACCIONES</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $adchb_data->Listar(); ?>
	</tbody>
</table>
<script type="text/javascript">
	$('#tbl-categoria').DataTable({});
</script>