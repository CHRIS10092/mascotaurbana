<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>
    <?php include 'contenido/head.php';?>
    <h2 class="blue">
        <!--<i class="ace-icon fa fa-plus bigger-110"></i>-->
        LISTADO DE VENTAS A EMPRESAS
    </h2>




<div id="listadoventas"></div>


   <!-- detallar <div>-->
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