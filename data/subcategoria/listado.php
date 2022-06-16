<?php 
require_once'../../clases/subcategoria.php';
$adchb_data=new subcategoria(); 
?>
<table id="tbl-sub" class="table table-striped table-hover">
	<thead>
		<tr class="info">
			<th>SUBCATEGORIA</th>
			<th>CATEGORIA</th>
			<th>ACCIONES</th>
		</tr>
	</thead>
	<tbody>
		
			<?php echo $adchb_data->Listar(); ?>
	</tbody>
</table>
<script type="text/javascript">
	$('#tbl-sub').DataTable({});
</script>