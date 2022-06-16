<?php 
require_once'../../clases/cliente.php';
$adchb_data=new cliente(); 
?>
<table id="tbl-cliente" class="table table-striped table-hover">
	<thead>
		<tr class="info">
			<th>CEDULA</th>
			<th>NOMBRES</th>
			<th>APELLIDOS</th>
			<th>CORREO</th>
			<th>CELULAR</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php echo $adchb_data->Listar(); ?>
	</tbody>
</table>
<script type="text/javascript">
	$('#tbl-cliente').DataTable({});
</script>