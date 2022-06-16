<?php
require_once "../../clases/nueva_venta.php";
$obj = new nueva_venta();

?>
<div class="table-responsive">
<table id="tbl-tenedorm" class="table table-responsive table-hover dataTable no-footer" style="height: 100%; width: 100%;">



<thead>
<tr>

	<th>RUC</th>
	<th>R.SOCIAL</th>
	<th>TELEFONO</th>

	<th>ACCION</th>

</tr>
</thead>

	<tbody>

	<?php echo $obj->listadoempresasventas(); ?>
	</tbody>

</table>
</div>
<script type="text/javascript">
	$('#tbl-tenedorm').DataTable({});

</script>