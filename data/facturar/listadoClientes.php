<?php 
require_once'../../clases/ClientesModel.php'; 
$obj = new ClientesModel;
?>
<div class="table-responsive">
	<table id="tblClientes" style="
    width: -webkit-fill-available;" class="table table-responsive">
		<thead>
			<tr>
				<th>Identificacion</th>
				<th>Nombre</th>
				<th>Apellido</th>
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
					<td><?php echo $data['cli_nombre']?></td>
					<td><?php echo $data['cli_apellido']?></td>
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

	$('#tblClientes').DataTable({   
		  language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
});
</script>
