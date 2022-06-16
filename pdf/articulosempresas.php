<?php
require_once "../clases/reportearticulos.php";
$obj = new reporte_articulos();

$buscarnart = $obj->BuscarAticulos();

?>
<style>
	.img2{


		  height:30px ;
		  width:30px ;
		  border-radius:100px;
		  margin-top: 10;

	}


	.h3{
		margin-top: 0px;
	}

	table {
   width: 100%;
   border: 1px solid #000;
}
th, td {
   width: 25%;
   text-align: left;
   vertical-align: top;
   border: 1px solid #000;
   border-collapse: collapse;
   padding: 0.3em;
   caption-side: bottom;
}
caption {
   padding: 0.3em;
   color: #fff;
    background: #000;
}
th {
   background: #eee;
}
</style>

<img  width="200" height="240" src="../imagenes/logocomprasegura.jpg">
<h3>LISTADO DE TODOS LOS ARTICULOS MASCOTA URBANA</h3>


<table>
	<tr>
		<th>Codigo</th>
		<th>CodigoUnico</th>
		<th>Nombre</th>
		<th>Descripcion</th>
		<th>Stock</th>
		<th>Valor</th>
		<th>Valor PVP</th>
		<th>Imagen</th>

	</tr>

<?php foreach ($buscarnart as $datos) {?>





	<tr>
		<th><?php echo $datos['art_id'] ?></th>
		<th><?php echo $datos['art_codigo'] ?></th>
		<th> <?php echo $datos['art_nombre']; ?></th>
		<th> <?php echo $datos['art_descripcion']; ?></th>
		<th> <?php echo $datos['art_stock']; ?></th>
		<th> <?php echo $datos['art_valor']; ?></th>
		<th> <?php echo $datos['art_valorpvp']; ?></th>
		<th>  <img class="img2" src="../<?php echo $datos['art_imagen'] ?>"  ></th>

	</tr>




<?php }?>

</table>

