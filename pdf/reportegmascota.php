<?php
require_once "../clases/reportemascota.php";
$obj = new reportemascota();

$buscarmas  = $obj->BuscarMascota($_GET['buscar']);
$buscarnten = $obj->BuscarIDTenedor($_GET['tenedor']);
?>
<style>
	.img2{


		  height:280px ;
		  width:280px ;
		  border-radius:100px;
		  margin-top: 10;

	}

.contenido{
	display: inline-block;
	margin-top: 0;
}

.contenidoimg{
float: left;
}


.conte{
	float: right;
	padding-right: 100px;

}

.datostenedor{
	display: block;
	margin-top: 400px;
}

.datostenedor1{
	display: block;
	margin-top: 370px;
}

.conte1{
	float: left;
	padding-top: : 111px;
	margin-top: 0px;

}
.contenido1{
	display: inline-block;
}
.contenidoimagen1{
	float: left;
	margin-top: 10px;
}
.img1{

		  height:110px ;
		  width:110px ;
		  border-radius:100px;
		  margin-top: 20px;
	}


	.h3{
		margin-top: 0px;
	}
</style>

<?php foreach ($buscarnten as $datos) {?>


	<div class="contenido">
		<div class="contenidoimg"> <img class="img2" src="../<?php echo $datos['ten_foto'] ?>"  > </div>
		<div class="conte" style="padding-top: 0; margin-top: 0">

 	<p > <strong style="color: red;">Cedula Tenedor:</strong><span style="text-decoration: underline;">  <?php echo $datos['ten_cedula'] ?> </span></p>
 	<p> Nombre Tenedor: <?php echo $datos['ten_primer_nombre'] ?> </p>

 	<p> Fecha de Nacimiento:<?php echo $datos['ten_fecha'] ?> </p>
 	<p> <strong style="color: green;">Celular</strong><?php echo $datos['ten_celular'] ?> </p>
 	<p> Correo:<?php echo $datos['ten_correo'] ?> </p>
 	<p> Provincia:<?php echo $datos['ten_provincia'] ?> </p>
 	<p> Canton:<?php echo $datos['ten_canton'] ?> </p>
 	<p> Parroquia:<?php echo $datos['ten_parroquia'] ?> </p>
 	<p> <strong style="color: green;">Barrio</strong><?php echo $datos['ten_barrio'] ?> </p>


		 </div>
		 </div>


<?php }?>


<div class="datostenedor1">


<?php foreach ($buscarmas as $datos) {
    ?>


	<div class="contenido1">

		<div class="contenidoimg1" >
				<p> <img  class="img1" src="../<?php echo $datos['mas_imagen'] ?>"  > </p>

			<?php $dir = "../codigosQr/";
    $filename     = $dir . $datos['mas_codigo'] . '.png';?>
			<p>  <img src="<?php echo $filename ?>"  > </p>
		</div>
<div class="conte1">

		<p>Cedula <?php echo $datos['mas_codigo']; ?> </p>
		<p>Nombre <?php echo $datos['mas_nombre']; ?> </p>
		<p>Sexo <?php echo $datos['mas_sexo']; ?> </p>
		<p>Fecha <?php echo $datos['mas_fecha']; ?> </p>
		<p>Color <?php echo $datos['mas_color']; ?> </p>
		<p>Especie <?php echo $datos['mas_tipo']; ?> </p>
		<p>Raza <?php echo $datos['idraza']; ?> </p>
		<p>Esterilizado <?php echo $datos['mas_esterilizado']; ?>  </p>

	</div>


</div>



<?php }?>

</div>