<?php
//session_start();
require_once "../../clases/mascotas.php";
$obj = new mascotas();

?>
<div class="table-responsive">

<table id="tbl-listadom" class="table table-responsive">
<thead>

<tr>

	<th>Cédula</th>
	<th>Nombre</th>
	<th>Sexo </th>
	<th>Fecha</th>
	<th>Color</th>
	<th>Color1</th>
	<th>Tipo</th>
	<th>Raza</th>
	<th>Descripción</th>
	<th>Imagen</th>
	<th>Tenedor</th>
	<th>Empresa</th>

	<th>Acciones</th>
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