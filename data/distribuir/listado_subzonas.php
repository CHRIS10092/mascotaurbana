<?php
require_once "../../clases/distribuir.php";
$obj=new  distribuir();
$datos = $obj->listar_subzonas($_GET["zona"]);
?>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Nombre Empresa</th>
			<th>Accion</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $dato):?>
			<?php 
		$data=$dato["emp_id"]."||".$_GET["articulo"]."||".$_GET["stock"];
		?>	
		<tr>
			<td><?php echo  $dato["emp_nombre"]?>	</td>
			<td>
				<input type="radio" name="subzonas" onchange="mostrar_cantidad('<?php echo $data  ?>');">
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>