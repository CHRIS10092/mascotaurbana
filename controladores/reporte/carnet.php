<?php
require_once "../../clases/reportemascota.php";
$obj = new reportemascota();

//$buscarten = $obj->BuscarTenedor($_GET['id']);
$buscarmas = $obj->BuscarIDMascota($_GET['id']);

//print_r($_GET);
?>
<div class="table-responsive">
 <table class="table table-responsive">

<thead>
	<tr>
		<th>CODIGOMASCOTA</th>
		<th>NOMBRE</th>
		<th>SEXO</th>
		<th>FECHA</th>
		<th>COLOR</th>
		<th>COLOR SEGUNDO</th>
		<th>TIPO MASCOTA</th>
		<th>RAZA</th>
		<th>ESTERELIZADO</th>
		<th>IMAGEN</th>
		<th>PDF</th>

	</tr>
</thead>

<?php foreach ($buscarmas as $datos) {?>

	<tr>
		<td> <?php echo $datos['mas_codigo']; ?> </td>
		<td> <?php echo $datos['mas_nombre']; ?> </td>
		<td> <?php echo $datos['mas_sexo']; ?> </td>
		<td> <?php echo $datos['mas_fecha']; ?> </td>
		<td> <?php echo $datos['mas_color']; ?> </td>
		<td> <?php echo $datos['mas_color_secundario']; ?> </td>
		<td> <?php echo $datos['mas_tipo']; ?> </td>
		<td> <?php echo $datos['idraza']; ?> </td>
		<td> <?php echo $datos['mas_esterilizado']; ?> </td>
		<td> <img width="40" height="40" src="../<?php echo $datos['mas_imagen'] ?>"; > </a> </td>
		<td><a target="_blank" href="../procesarpdf/procesar_vacunas.php?id=<?php echo $datos['mas_codigo']; ?>&&da=<?php echo $_GET['id']; ?> "> Generar PDF  </a></td>


	</tr>


<?php }?>
 </table>
 </div>