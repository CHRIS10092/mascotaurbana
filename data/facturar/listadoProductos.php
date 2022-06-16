<?php 
require_once'../../clases/ProductosModel.php'; 
$obj = new ProductosModel;
?>
<div class="table-responsive">
			<table id="tblProductss" class="table table-responsive">
				<thead>
					<tr>
						<th>Codigo</th>
						<th width="100%">Detalle</th>
						<th>Precio Unitario</th>
						<th>Stock</th>
						<th>Ac.</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($obj->GetProductos() as $data): ?>
						<tr>
							<td><?php echo $data['inv_codigo'] ?></td>
							<td><?php echo $data['detalle'] ?></td>
							<td><?php echo $data['inv_valorpvp'] ?></td>
							<td><?php echo $data['inv_stock'] ?></td>
							<td>
								<button class="btn btn-primary" data-producto='<?php print_r(json_encode($data)) ?>' onclick="capturarProducto(event)">Seleccionar</button>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
			<script type="text/javascript">
				
	$('#tblProductss').DataTable({})
</script>


