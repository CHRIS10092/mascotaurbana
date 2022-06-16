<?php
require_once "../clases/reportemascota.php";
$OBJ         = new reportemascota();
$buscaridmas = $OBJ->BuscarIDMascota($_GET['buscar']);
$buscarid    = $OBJ->BuscarTenedor($_GET['da']);
?>
<style>
	.img1{


		  height:180px ;
		  width:120px ;
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
	padding-right: 189px;

}
.conte1{
	float: left;
	padding-right: 0px;

}

.datostenedor{
	display: block;
	margin-top: 270px;
}
.datostenedor1{
	display: block;
	margin-top: 370px;
}
</style>

<img src="../archivos/1722296686001/logo/logocomprasegura.jpg" width="70px" height="50px" >
 	<?php foreach ($buscaridmas as $datos) {
    ?>

	<div class="contenido">
		<div class="contenidoimg"> <img class="img1"  src="../<?php echo $datos['mas_imagen'] ?>"  > </div>
		<div class="conte">

 	<p > <strong style="color: red;">Cédula Mascota:</strong><span style="text-decoration: underline;">  <?php echo $datos['mas_codigo'] ?> </span></p>
 	<p> Nombre Mascota: <?php echo $datos['mas_nombre'] ?> </p>
 	<p> Sexo:<?php echo $datos['mas_sexo'] ?> </p>
 	<p> Fecha de Nacimiento:<?php echo $datos['mas_fecha'] ?> </p>
 	<p> Color:<?php echo $datos['mas_color'] ?> </p>
 	<p> Color Secundario:<?php echo $datos['mas_color_secundario'] ?> </p>
 	<p> Especie:<?php echo $datos['mas_tipo'] ?> </p>
 	<p>  Raza:<?php echo $datos['idraza'] ?> </p>
 	<p> <strong style="color: green;">Esterelizado</strong><?php echo $datos['mas_esterilizado'] ?> </p>
<?php
$dir      = "../codigosQr/";
    $filename = $dir . $datos['mas_codigo'] . ".png";?>
		  <img src="<?php echo $filename ?>"  >
		 </div>

		 </div>






<?php }?>


<div class="datostenedor1">
<h4>Datos del Tenedor</h4>


 	<?php foreach ($buscarid as $datos) {?>

<div class="contenido1">

		<div class="contenidoimagen1">


	<p> <strong style="color: red;">Cédula Tenedor:</strong><span style="text-decoration: underline;">  <?php echo $datos['ten_cedula'] ?> </span></p>
 	<p> Primer Nombre: <?php echo $datos['ten_primer_nombre'] ?> </p>
 	<p> Segundo Nombre: <?php echo $datos['ten_segundo_nombre'] ?> </p>
 	<p> Apellido Paterno:<?php echo $datos['ten_apellido_paterno'] ?> </p>
 	<p> Apellido Materno:<?php echo $datos['ten_apellido_materno'] ?> </p>
 	<p> Provincia:<?php echo $datos['ten_provincia'] ?> </p>
 	<p> Canton:<?php echo $datos['ten_canton'] ?> </p>
 	<p> Parroquia:<?php echo $datos['ten_parroquia'] ?> </p>
 	<p> Barrio:<?php echo $datos['ten_barrio'] ?> </p>
 	<p> Referencia Casa:<?php echo $datos['ten_referencia_casa'] ?> </p>



			</div>

<div class="conte1"> <img class="img2" src="../<?php echo $datos['ten_foto'] ?>"  >
 </div>
</div>


<?php }?>
</div>
