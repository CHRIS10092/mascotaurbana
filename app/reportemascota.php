<?php
session_start();

require_once("../app/contenido/head.php");
?>



<div class="row">
    <div class="col-md-4">
        <label>Buscar Con Cedula del <span style="background-color:aliceblue">Tenedor</span></label>
        <input type="text" id="txt-buscar" name="buscar" class="form-control col-md-9"
            placeholder="DIGITE EL NUMERO DE CEDULA DEL TENEDOR">

    </div>
    <br>
    <div>
        <div class="col-md-3">
            <button class="form-control btn btn-success" id="btn-buscar">Buscar</button>
        </div>
    </div>
</div>
<div class="responsive" id="reportems"></div>



<?php require_once("../app/contenido/foot.php"); ?>

<script type="text/javascript" src="../js/reportemascota.js"></script>