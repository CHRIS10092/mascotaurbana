<?php 
session_start();
if (isset($_SESSION['usuario'])) {
 ?>
<?php include 'contenido/head.php';?>
<div class="col-md-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-4">
    <div class="widget-box ui-sortable-handle" id="widget-box-4">
        <div class="widget-header widget-header-large">
            <h4 class="widget-title">Listado de Clientes</h4>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div id="listado"></div>
            </div>
        </div>
    </div>
</div>

<div id="m-detalle" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">DETALLE DE VENTA</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                   <center><h4 id="infoVenta"></h4></center>
                   <div id="detallar"></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>
<?php include 'contenido/foot.php';?>
<script src="../js/historial_venta.js"></script>
<?php } else {
    header("location: ../");
}
?>