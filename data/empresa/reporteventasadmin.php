
<?php
require_once '../../clases/empresas.php';
$obj = new empresa();

?>


<table id="listadoreporte" class="table table-responsive">

<thead>

<tr>
	<th>CODIGO</th>
	<th>NOMBRE EMPRESA</th>
	<th>NUMERO FACTURA</th>
	<th>FECHA</th>

	<th>TOTAL</th>
	<th>ACCIONES</th>
</tr>

</thead>
<tbody>

	 <?php echo $obj->reportesventasadmin(); ?>
</tbody>


</table>
<script type="text/javascript">
	$('#listadoreporte').DataTable({});

</script>