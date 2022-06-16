<?php
require_once '../../clases/vacunas.php';
$vac = new vacunas();
?>

<table id="listadovac" class="table table-responsive">

<thead>
		<th>CODIGO</th>
		<th>DESCRIPCION</th>
		<th>TIPO</th>
		<th>ACCIONES</th>
</thead>
<tbody>

<?php echo $vac->listarvacuna(); ?>


</tbody>

</table>

<script type="text/javascript">
	$('#listadovac').DataTable({});
</script>