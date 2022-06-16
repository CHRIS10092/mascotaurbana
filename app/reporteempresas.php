<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>
<?php include 'contenido/head.php';?>
<div class="col-md-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-4">
    <div class="widget-box ui-sortable-handle" id="widget-box-4">
        <div class="widget-header widget-header-large">
            <h4 class="widget-title">Listado de Venta a los Clientes</h4>
            <div class="widget-toolbar">

            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div id="correcto"></div>


<div class="table table-responsive" id="list-empresasventas"></div>
            </div>
        </div>
    </div>
</div>
<div id="mVer" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div id="ver-orden"></div>
      </div>
    </div>

  </div>
</div>


<?php include 'contenido/foot.php';?>
<script src="../js/nueva_venta_admin.js"></script>
<?php } else {
    header("location: ../");
}
?>