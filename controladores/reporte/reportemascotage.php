<?php
require_once "../../clases/reportemascota.php";
$obj = new reportemascota();

$buscarten = $obj->BuscarTenedor($_GET['id']);
$buscarmas = $obj->BuscarMascota($_GET['id']);

//print_r($_GET);
?>
<br>


 <ul>
 	<?php foreach ($buscarten as $datos) {?>

 	<li><strong>CEDULA:</strong> <?php echo $datos['ten_cedula'] ?> </li>
 	<li>NOMBRE: <?php echo $datos['ten_primer_nombre'] ?> </li>
 	<li>SEGUNDO NOMBRE: <?php echo $datos['ten_segundo_nombre'] ?> </li>
 	<li>APELLIDO: <?php echo $datos['ten_apellido_paterno'] ?> </li>
 	<li>SEGUNDO APELLIDO: <?php echo $datos['ten_apellido_materno'] ?> </li>
 	<li>FECHA DE NACIMIENTO: <?php echo $datos['ten_fecha'] ?> </li>
 	<li>CORREO: <?php echo $datos['ten_correo'] ?> </li>
 	<li>CELULAR: <?php echo $datos['ten_celular'] ?> </li>
 	<li>PROVINCIA: <?php echo $datos['ten_provincia'] ?> </li>
 	<li>CANTON: <?php echo $datos['ten_canton'] ?> </li>
 	<li>PARROQUIA: <?php echo $datos['ten_parroquia'] ?> </li>
 	<li>BARRIO: <?php echo $datos['ten_barrio'] ?> </li>
 	<li>CALLE PRINCIPAL: <?php echo $datos['ten_calle_principal'] ?> </li>
 	<li>NUMERO CASA: <?php echo $datos['ten_numero_casa'] ?> </li>
 	<li>CALLE SECUNDARIA: <?php echo $datos['ten_calle_secundaria'] ?> </li>
 	<li>REFERENCIA: <?php echo $datos['ten_referencia_casa'] ?> </li>
 	<li>FOTO: <img width="40" height="40" src="../<?php echo $datos['ten_foto'] ?>"; > </a> </li>




<?php }?>
 </ul>

<a target="_blank" href="../procesarpdf/reportegeneralmascota.php?id=<?php echo $_GET['id']; ?>&&tenedor=<?php echo $datos['ten_cedula']; ?>">REPORTE GENERAL</a>
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
		<td><a target="_blank" href="../procesarpdf/procesarmascotaunica.php?id=<?php echo $datos['mas_codigo']; ?>&&da=<?php echo $_GET['id']; ?> "> Generar PDF  </a></td>


	</tr>


<?php }?>
 </table>
 </div>