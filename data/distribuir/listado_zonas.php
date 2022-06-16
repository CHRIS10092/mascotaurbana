<?php
require_once "../../clases/distribuir.php";
$obj=new  distribuir();
$datos = $obj->listar_zonas();
?>

<table id="tbl-distribuir" class="table table-striped">
	<thead>
		<tr>
			<th>TiposEmpresas</th>
			<th>Accion</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $dato):?>
		<?php 
		$data=$dato["id"]."||".$_GET["articulo"]."||".$_GET["stock"];
		?>	
		<tr>
			<td><?php echo  $dato["rol"]?>	</td>
			<td>
				<input type="radio" name="zonas" onchange="listar_subzonas('<?php echo $data ?>')">
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<script type="text/javascript">
	$('#tbl-distribuir').DataTable({});
</script>