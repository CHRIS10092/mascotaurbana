<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>
<?php include 'contenido/head.php';?>
<div class="col-md-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-4">
    <div class="widget-box ui-sortable-handle" id="widget-box-4">
        <div class="widget-header widget-header-large">
            <h4 class="widget-title">Listado de Respuestas</h4>
</div>

        <div class="widget-body">
            <div class="widget-main">
            
                <div id="listado"></div>
            </div>
        </div>
    </div>
</div>


<?php require_once 'contenido/foot.php';?>


<script src="../js/respuestas.js"></script>


<?php

} else {

header("location: ../");
}

?>