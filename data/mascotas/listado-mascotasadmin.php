<?php
//session_start();
require_once "../../clases/mascotas.php";
$obj = new mascotas();

?>
<div class="table-responsive">

<table id="tbl-listadom" class="table table-responsive">
<thead>

<tr>

	<th>CEDULA</th>
	<th>NOMBRE</th>
	<th>SEXO </th>
	<th>FECHA</th>
	<th>COLOR</th>
	<th>COLORU</th>
	<th>TIPO</th>
	<th>RAZA</th>
	<th>DESCRIPCION</th>
	<th>IMAGEN</th>
	<th>TENEDOR</th>
	<th>EMPRESA</th>

	<th>ACCIONES</th>
</tr>

</thead>
<tbody>
	<?php echo $obj->listadomascotasadmin() ?>
</tbody>


</table>
</div>
<script type="text/javascript">
	$('#tbl-listadom').DataTable({});
</script>