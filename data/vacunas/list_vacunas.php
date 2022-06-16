<?php

require_once '../../clases/vacunas.php';

$obj     = new vacunas();
$$result = $obj->buscar_historial($_POST['txt-buscar']);
?>
<table class="table table-hover table-condensed">
	<tr>
		<th>Equipo</th>
		<th>Fundacion</th>
		<th>Presidente</th>
		<th>Acciones</th>
	</tr>
	<?php foreach ($result as $datos): ?>
	<tr>
		<td><?php echo $datos['idmascota'] ?></td>
		<td><?php echo $datos['idmascota'] ?></td>
		<td><?php echo $datos['idmascota'] ?></td>
		<td>
			<button class="btn btn-success"  onclick="listarvacuna('<?php echo $datos['idmascota'] ?>')">
				<i class="fa fa-users"></i>
				 Ver Jugadores
			</button>
		</td>
	</tr>
	<?php endforeach?>
</table>