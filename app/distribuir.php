<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>
<?php
require_once "contenido/head.php";

    ?>

<div class="row">
	<div class="col-md-3">
	<label>Tipo de Articulo</label>
	<div id="listado-tipos"></div>
	</div>
	<div class="col-md-2"><br>
		<button class="btn btn-success" id="btnBuscarTipo">BUSCAR</button>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-5">
		<div id="listado-articulos"></div>
	</div>
	<div class="col-md-3">
		<div id="listado-zonas"></div>
	</div>
	<div class="col-md-2">
		<div id="listado-subzonas"></div>
	</div>
	<div class="col-md-2">
		<div id="elementos"></div>
	</div>
</div>




<?php require_once 'contenido/foot.php';?>
<script src="../js/distribuir.js"></script>
<?php } else {
    header("location: ../");
}
?>



