<?php 
require_once'../../clases/usuario.php';
$adchb_data=new usuario(); 
?>
<table id="tbl-usuario" class="table table-striped table-hover">
	<thead>
		<tr class="info">
			<th>NOMBRE</th>
			<th>USUARIO</th>
			<th>CORREO</th>
			<th>DIRECCION</th>
			<th>CELULAR</th>
			<th>PERFIL</th>
			<th>REGISTRO</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php echo $adchb_data->Listar(); ?>
	</tbody>
</table>
<script type="text/javascript">
	$('#tbl-usuario').DataTable({});
</script>