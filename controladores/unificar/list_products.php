<?php
session_start();
require_once '../../clases/unificar.php';
$obj   = new Unificar;
$datos = $obj->list_products($_SESSION['empresa']['idempresa'], $_SESSION['sucursal']['codigo']);
?>
<?php foreach ($datos as $dato): ?>
<tr>
	<td width='5%'> <?php echo $dato["inv_codigo"] ?></td>
	<td width='15%'><?php echo $dato["inv_nombre"] ?></td>
	<td width='5%'><?php echo $dato["inv_stock"] ?></td>
	<td width='5%'><?php echo $dato["inv_valorpvp"] ?></td>
	<td>

		<img src="../<?php echo $dato["inv_imagen"] ?>" height="100px" width="100px">
	</td>
	<td>
		<button data-info="<?php echo implode("||", $dato) ?>" onclick="agregar(event)">Seleccionar</button>
	</td>
</tr>
<?php endforeach?>
