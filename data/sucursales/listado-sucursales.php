<?php
require_once '../../clases/sucursales.php';
$obj = new sucursal();
?>
<table id="tbl-usuario" class="table table-striped table-hover">
	<thead>
		<tr class="info">
			<th>Código</th>
			<th>Nombre Sucursal</th>
			<th>Dirección Sucursal</th>
			<th>Teléfono</th>
			<th>Punto Emisión</th>
			<th>Número Factura</th>
			<th> Estado</th>
			<th> Empresa</th>
			<th> Iva</th>
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