<?php
require_once "../../clases/vacunas.php";
$obj = new vacunas();

$buscarmas       = $obj->BuscarMascota($_GET['id']);
$buscarhistorial = $obj->buscar_historial($_GET['id']);

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



	</tr>


<?php }?>
 </table>
 </div>

 <!--<div class="form-group row">

<table class="table table-responsive">

<thead>
	<tr>
		<th>CODIGOMASCOTA</th>
		<th>DESCRIPCION</th>
		<th>MASCOTA</th>


		<th>SELECIONAR</th>

	</tr>
</thead>

<?php foreach ($buscarhistorial as $datos) {?>

	<tr>
		<td style="width: 10%"> <?php echo $datos['his_id']; ?> </td>
		<td> <?php echo $datos['his_descripcion']; ?> </td>
		<td> <?php echo $datos['idmascota']; ?> </td>
		<td><button id="btn-seleccionar" name="seleccionar" data-toggle="modal" data-target="#n-vacuna" class="btn-success" onclick="listarvacuna('<?php echo $datos['idmascota'] ?>');" >	<i class="fa fa-eye">APLICAR</i> </button>

		</td>
	</tr>


<?php }?>


 </table>
 </div>-->