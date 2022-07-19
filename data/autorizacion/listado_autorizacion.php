<?php
session_start();
require_once '../../clases/NotasCredito.php';
$adchb_data = new NotasCredito();
$datos=$adchb_data->repor($_SESSION['empresa']['idempresa'],$_SESSION['sucursal']['codigo']);
//print_r($datos);
?>

<?php foreach($datos as $obj) : ?>
<tr>
		<td><?php echo $obj['ven_numero'] ?></td>
		<td><?php echo $obj['ven_fecha'] ?></td>
		<td><?php echo $obj['cli_rucci'] ?></td>
		<td><?php echo $obj['estado'] ?></td>
	<td>
		<a class="btn btn-primary btn-xs" href="notascredito.php?id=<?php echo $obj['ven_numero'] ?>">
			Registrar Devolución
		</a>
	</td>
	</tr>
<?php endforeach ?>

<script type="text/javascript">
	$('#tbl-articulo').DataTable({});
</script>