<?php
//session_set_cookie_params(60*60*24*1)//para un dia
session_start();
require_once "../helpers/funciones.php";
require_once "../clases/VentasModel.php";
date_default_timezone_set("America/Lima");
$fecha=date('Y-m-d');
$venta = new VentasModel;
$secuencia = $venta->GetNumero($_SESSION['empresa']['idempresa']);
$numero = secuenciales($secuencia, 2);



if (isset($_SESSION['usuario'])) {
?>
<?php include 'contenido/head.php'; ?>
<h2 class="blue">
    <i class="ace-icon fa fa-plus bigger-110"></i>
    Ficha Técnica
</h2>
<div class="row">

<form id="FrmFicha">
<div class="row">
<div class="col-sm-12">
<p> Ficha Número</p> <p value="<?php  echo $numero ?>"></p>
</div>

</div>
<div class="row">
<div class="col-md-7">
    <div class="col-sm-3 input-sm" >
<label for="">Cédula de Mascota</label>
</div>
<div>
<input type="text" id="cedula" name="cedula">
</div>
</div>
</div>
<div class="row">
<div class="col-md-7">
<div class="col-sm-3 input-sm" >

<label for="">Nombre Mascota </label>
</div>
<div>
<input type="text" id="cedula" name="cedula">
</div>
</div>
</div>
<div class="row">
<div class="col-md-7">
<div class="col-sm-3 input-sm" >

<label for="">Peso   Mascota </label>
</div>
<div>
<input type="text" id="cedula" name="cedula">
</div>
</div>
</div>

</form>
</div>



<?php include 'contenido/foot.php'; ?>
<script src="../js/fichatecnica.js"></script>
<?php } else {
	header("location: ../");
}
?>