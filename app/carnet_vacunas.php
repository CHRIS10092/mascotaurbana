<?php
session_start();

require_once "../app/contenido/head.php";
?>

<h3>Ver Carnet Mascota</h3>

<div class="row">
    <div class="col-md-3">
        <label>Buscar Con Cedula de Microchip</label>
        <input type="text" id="txt-buscar" name="buscar" class="form-control">

    </div>
    <br>
    <div>
        <div class="col-md-3">
            <button class="form-control btn btn-success" id="btn-buscar">Buscar</button>
        </div>
    </div>
</div>
<div class="responsive" id="reportems"></div>








<?php require_once "../app/contenido/foot.php"; ?>

<script type="text/javascript" src="../js/carnet_vacuna.js"></script>