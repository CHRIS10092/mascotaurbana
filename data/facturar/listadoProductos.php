<?php 
session_start();
require_once'../../clases/ProductosModel.php'; 
$obj = new ProductosModel;
?>
<div class="table-responsive">
			<table id="tblProductss" class="table table-responsive">
				<thead>
					<tr>
						
						<th>Id</th>
						<th>Codigo</th>
						<th width="100%">Detalle</th>
						<th>Precio Unitario</th>
						<th>Stock</th>
						<th>Valor Pvp</th>
						<th>Ac.</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($obj->GetProductos($_SESSION['empresa']['idempresa'],$_SESSION['sucursal']['codigo']) as $data): ?>
						<tr>
							<td><?php echo $data['inv_id'] ?></td>		
							<td><?php echo $data['inv_codigo'] ?></td>	
							<td><?php echo $data['detalle'] ?></td>
							<td><?php echo $data['inv_valorpvp'] ?></td>
							<td><?php echo $data['inv_stock'] ?></td>
							<td><?php echo $data['inv_valor'] ?></td>
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


