<?php 
require_once'../../clases/ubicar.php';
$adchb_data=new ubicar(); 
?>
<table id="tbl-ubicar" class="table table-striped table-hover">
	<thead>
		<tr class="info">
			<th>CODIGO</th>
			<th>NOMBRE</th>
			<th>DESCRIPCION</th>
			<th>CANT</th>
			<th>FORMA FARMACEUTICA</th>
			<th>UNIDAD DE MEDIDA</th>
			<th>CATEGORIA</th>
			<th>SUBCATEGORIA</th>
			<th>UBICAR</th>
			
		</tr>
	</thead>
	<tbody>
		<?php echo $adchb_data->Listar(); ?>
	</tbody>
</table>
<script type="text/javascript">
	$('#tbl-ubicar').DataTable({});
</script>