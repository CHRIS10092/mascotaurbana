<?php 
require_once'../../clases/nueva_venta.php';
$adchb_data=new nueva_venta(); 
?>
<table class="table table-striped table-hover">
    <thead>
        <tr class="info">
            <th>ARTICULO</th>
            <th>NOMBRE</th>
            <th>DESCRIPCION</th>
            <th>CANTIDAD</th>
            <th>PRECIO</th>
            <th>TOTAL</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach($adchb_data->VerDetalle($_GET["id"]) as $datos):?>

        <tr>
            <td><img width="200px" height="150px" src="<?php echo "../".$datos["img"]?>"></td>
            <td><?php echo $datos["nombre"]?></td>
            <td><?php echo $datos["descripcion"]?></td>
            <td><?php echo $datos["cantidad"]?></td>
            <td><?php echo $datos["precio"]?></td>
            <td><?php echo $datos["total"]?></td>
        </tr>
		<?php endforeach?>
    </tbody>
</table>