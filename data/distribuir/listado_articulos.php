<?php
require_once "../../clases/distribuir.php";
$obj=new  distribuir();
$datos = $obj->listar_articulos($_GET["tipo"]);
?>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Npmbre</th>
			<th>Descripcion</th>
			<th>Stock</th>
			<th>Valor</th>
			<th>Accion</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $dato):?>
				<?php 
		$data=$dato["id_a"]."||".$dato["stock"];
		?>
		<tr>
			<td><?php echo  $dato["codigo"]?>	</td>
			<td><?php echo  $dato["nombre"]?>	</td>
			<td><?php echo  $dato["descripcion"]?>	</td>
			<td><?php echo  $dato["stock"]?>	</td>
			<td><?php echo  $dato["valor"]?>	</td>
			<td>
				<button class="btn btn-primary" onclick="listar_zonas('<?php echo $data  ?>')">Distribuir</button>
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>