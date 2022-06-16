<?php
require_once '../../clases/VentasModel.php';
session_start();
$objeto = new VentasModel;
$obj    = $objeto->FacturasChips($_SESSION['empresa']['idempresa'],$_SESSION['sucursal']['codigo']);
?>
<?php foreach ($obj as $datos): ?>
<tr>
	<td><?php echo $datos['ven_numero']?></td>
	<td><?php echo $datos['ven_fecha']?></td>
	<td><?php echo $datos['cliente']?></td>
	<td>
		<a class="btn btn-primary btn-xs" href="procesar1.php?id=<?php echo $datos['ven_id'] ?>">
			Registrar Chip
		</a>
	</td>
</tr>	
<?php endforeach ?>
