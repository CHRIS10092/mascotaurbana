<?php
require_once '../../clases/sucursales.php';
$obj = new sucursal();
?>
<table id="tbl-usuario" class="table table-striped table-hover">
	<thead>
		<tr class="info">
			<th>CODIGO</th>
			<th>NOMBRE SUCURSAL</th>
			<th>DIRECCION SUCURSAL</th>
			<th>TELEFONO</th>
			<th>NUMERO ESTRUCTURA</th>
			<th>NUMERO DE FACTURA</th>
			<th> ESTADO</th>
			<th> EMPRESA</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php echo $obj->Listar(); ?>
	</tbody>
</table>
<script type="text/javascript">
	$('#tbl-usuario').DataTable({});
</script>