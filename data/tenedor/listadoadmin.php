<?php
require_once "../../clases/tenedor.php";
$obj = new tenedor();

?>
<div class="table-responsive">
<table id="tbl-tenedor" class="table table-responsive">

<thead>
<tr class="info">

	<th>CEDULA</th>
	<th>NOMBRE</th>
	<th>S_NOMBRE</th>
	<th>APELLIDO</th>
	<th>APELLIDOSEG</th>
	<th>TELEFONO</th>
	<th>IMAGEN</th>
	<th>EMPRESA</th>

	<th>ACCION</th>

</tr>
</thead>

	<tbody>

		<?php echo $obj->listadotenedoradmin(); ?>
	</tbody>


</table>
</div>
<script type="text/javascript">
	$('#tbl-tenedor').DataTable({});
</script>