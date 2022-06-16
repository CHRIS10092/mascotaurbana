<?php 
require_once'../../clases/nueva_venta.php';
$adchb_data=new nueva_venta(); 
?>
<table id="tbl-venta" class="table table-striped table-hover">
    <thead>
        <tr class="info">
            <th>VENTA NUMERO</th>
            <th>CLIENTE</th>
            <th>FECHA DE VENTA</th>
            <th>ZONA</th>
            <th>SUBZONA</th>
            <th>ACCION</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach($adchb_data->ListarHistorial() as $datos):?>
	<?php $data = $datos["numero"]."||".$datos["client"]?>
        <tr>
            <td><?php echo $datos["numero"]?></td>
            <td><?php echo $datos["client"]?></td>
            <td><?php echo $datos["fecha"]?></td>
            <td><?php echo $datos["zona"]?></td>
            <td><?php echo $datos["subzona"]?></td>
            <td><button class="btn btn-success" data-toggle="modal" data-target="#m-detalle" onclick="capturar('<?php echo $data?>')">Ver Detalle</button></td>
        </tr>
		<?php endforeach?>
    </tbody>
</table>
<script type="text/javascript">
$('#tbl-venta').DataTable({});
</script>