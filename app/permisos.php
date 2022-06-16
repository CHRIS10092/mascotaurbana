<?php 
session_start();
require_once("../app/contenido/head.php") ?>

<div class="row">
	<div class="col-md-6">
		<label>ESCOGER USUARIO</label>
	<div id="permisos"> </div>
		</div>
	</div>
	<div class="row">
	<div class="col-md-6">
<label>ESCOGER EMPRESA</label>
<div id="listarempresa"> </div>
</div>
</div>
<br>
<br>
<div class="row">
<div class="col-md-6">
<button id="btn-agregar" class="form-control btn btn-success" name="">AGREGAR  USUARIO </button>	
</div>	
</div>






<?php require_once("../app/contenido/foot.php") ?>
<script type="text/javascript" src="../js/permisos.js"></script>