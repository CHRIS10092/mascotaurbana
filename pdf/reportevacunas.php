<?php
require_once "../clases/reportemascota.php";
$OBJ             = new reportemascota();
$buscaridmas     = $OBJ->BuscarIDMascota($_GET['buscar']);
$buscarid        = $OBJ->BuscarMascotaVac($_GET['da']);
$buscarides      = $OBJ->BuscarMascotaDes($_GET['da']);
$buscarseguro    = $OBJ->BuscarMascotaSeg($_GET['da']);
$buscarexzequial = $OBJ->BuscarMascotaExz($_GET['da']);

?>
<style>
	.img1{


		  height:180px ;
		  width:180px ;
		  border-radius:100px;
		  margin-top: 20;
	}

.img2{


		  height:100px ;
		  width:100px ;
		  border-radius:100px;
		  margin-top: 20;
	}
.contenido{
	display: inline-block;
}

.contenidoimg{
float: left;
}


.conte{
	float: right;
	padding-right: 111px;

}
.conte1{
	float: left;
	padding-right: 0px;

}

.datostenedor{
	display: block;
	margin-top: 370px;
}
.datostenedor1{
	display: block;
	margin-top: 370px;
}
table {
  display: table;
  border: 0.4px solid black;
  border-spacing: 1px;
  border-color: gray;

 border-collapse: collapse;
   margin: 0 0 1em 0;
   caption-side: top;

}


table tr,td{
border-bottom: 1px solid #999;
   width: 25%;
     border-right: 1px solid #000;
     /*font-family: 'Arial';*/

}
tr:nth-child(even){
background-color: #45A3BC;
}
tr:nth-child(odd) {
  background-color: #77A840;
}
#color1{color:#FFF;
}
#color2{color:#F2F;
}

</style>


 	<?php foreach ($buscaridmas as $datos) {
    ?>

	<div class="contenido">
		<div class="contenidoimg"> <img class="img1"  src="../<?php echo $datos['mas_imagen'] ?>"  > </div>
		<div class="conte">

 	<p > <strong style="color: red;">Cedula Mascota:</strong><span style="text-decoration: underline;">  <?php echo $datos['mas_codigo'] ?> </span></p>
 	<p> Nombre Mascota: <?php echo $datos['mas_nombre'] ?> </p>
 	<p> Sexo:<?php echo $datos['mas_sexo'] ?> </p>
 	<p> Fecha de Nacimiento:<?php echo $datos['mas_fecha'] ?> </p>
 	<p> Color:<?php echo $datos['mas_color'] ?> </p>
 	<p> Color Secundario:<?php echo $datos['mas_color_secundario'] ?> </p>
 	<p> Especie:<?php echo $datos['mas_tipo'] ?> </p>
 	<p>  Raza:<?php echo $datos['idraza'] ?> </p>
 	<p> <strong style="color: green;">Esterelizado</strong><?php echo $datos['mas_esterilizado'] ?> </p>
 	<p> <strong style="color: green;">Medico Veterinario</strong><?php echo $datos['usu_primernombre'] ?> <?php echo $datos['usu_apellidopaterno'] ?> </p>
<?php
$dir      = "../codigosQr/";
    $filename = $dir . $datos['mas_codigo'] . ".png";?>
		  <img src="<?php echo $filename ?>"  >
		 </div>

		 </div>






<?php }?>


<div class="datostenedor1" style="
    margin-top: 392px;
">
<h4>Historial</h4>

<table style="width: 100%" >
	<tr style="background-color: white">
		<td >Tipo</td>
		<td>Nombre de Vacuna</td>
		<td>Descripcion</td>
		<td>Fecha Vacuna</td>
		<td>Fecha Proxima Vacuna</td>

	</tr>

 	<?php foreach ($buscarid as $datos) {?>




	<tr id="color1" >
		<td  ><?php echo $datos['inv_nombre']; ?></td>
		<td  ><?php echo $datos['inv_descripcion']; ?></td>
		<td ><p>  <?php echo $datos['his_descripcion'] ?> </p></td>
		<td   ><?php echo $datos['fecha_vacuna']; ?></td>
		<td ><?php echo $datos['his_fecha_proxima']; ?></td>

	</tr>




<?php }?>
</table>
</div>

<div class="datostenedor1" style="
    margin-top: 0px;
">
<h4>Historial Desparacitante</h4>
<table class="table table-responsive" style="width: all;">
		<tr>

				<td >Tipo</td>
				<td>Nombre Desparacitante</td>
				<td>Fecha</td>



		</tr>


 	<?php foreach ($buscarides as $datos) {?>




	<tr>

	<td><p>  <?php echo $datos['inv_nombre']; ?> </p></td>
	<td><p>  <?php echo $datos['inv_descripcion']; ?> </p></td>
	<td><p>  <?php echo $datos['des_fecha']; ?> </p></td>



	</tr>



<?php }?>
</table>
</div>


<div class="datostenedor1" style="
    margin-top: 0px;
">
<h4>Historial Seguro Medico</h4>



	<table style="width: all;">
		<tr>
			<td>Tipo</td>
			<td>Nombre</td>
			<td>Fecha</td>
			<td>Fecha Final de Seguro</td>
		</tr>

 	<?php foreach ($buscarseguro as $datos) {?>




	<tr>
		<td><p>  <?php echo $datos['inv_nombre']; ?> </p></td>
	<td><p>  <?php echo $datos['inv_descripcion']; ?> </p></td>
	<td><p>  <?php echo $datos['seg_fecha']; ?> </p></td>
	<td><p>  <?php echo $datos['seg_fecha_proxima']; ?> </p></td>




	</tr>



<?php }?>
	</table>

</div>
<div class="datostenedor1" style="
    margin-top: 0px;
">
<h4>Exequial</h4>


	<table style="width: all;">
		<tr>
			<td>Tipo</td>
			<td>Nombre</td>
			<td>Fecha</td>
			<td>Fecha Final </td>
		</tr>

 	<?php foreach ($buscarseguro as $datos) {?>
<tr>

	<td><p>  <?php echo $datos['inv_nombre']; ?> </p></td>
	<td><p>  <?php echo $datos['inv_descripcion']; ?> </p></td>
	<td><p>  <?php echo $datos['exe_fecha']; ?> </p></td>
	<td><p>  <?php echo $datos['exe_fecha_proxima']; ?> </p></td>




	</tr>

  <?php }?>



	</table>

</div>