<?php 
require_once'../../clases/ClientesModel.php'; 
$obj = new ClientesModel;
?>
<div class="table-responsive">
	<table id="tblClientes" class="table table-responsive">
		<thead>
			<tr>
				<th>Identificacion</th>
				<th>Cliente</th>
				<th>Direccion</th>
				<th>Correo</th>
				<th>Celular</th>
				<th>Ac.</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($obj->GetClientes() as $data): ?>
				<tr>
					<td><?php echo $data['cli_rucci'] ?></td>
					<td><?php echo $data['cli_nombre']." ".$data['cli_apellido'] ?></td>
					<td><?php echo $data['cli_direccion'] ?></td>
					<td><?php echo $data['cli_correo'] ?></td>
					<td><?php echo $data['cli_celular'] ?></td>
					<td>
						<button class="btn btn-primary" data-cliente='<?php print_r(json_encode($data)) ?>' onclick="capturarCliente(event)">Seleccionar</button>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
<script type="text/javascript">

	$('#tblClientes').DataTable({})
</script>
