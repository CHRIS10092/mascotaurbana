<?php 
require_once'../../clases/ubicar.php';
$adchb_data=new ubicar(); 
?>
<table id="tbl-bodega" class="table table-striped table-hover">
	<thead>
		<tr class="info">
			<th>CODIGO</th>
			<th>NOMBRE</th>
			<th>DETALLE</th>
			<th>CANTIDAD</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $adchb_data->ListarMedicamentos($_POST['id']); ?>
	</tbody>
</table>
