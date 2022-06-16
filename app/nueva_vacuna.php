<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>
<?php include 'contenido/head.php';?>

<div class="col-md-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-4">
    <div class="widget-box ui-sortable-handle" id="widget-box-4">
        <div class="widget-header widget-header-large">
            <h4 class="widget-title">Generar  Vacunas</h4>


        </div>


    </div>


<!-- Modal -->
<div id="n-vacuna" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">LISTAR vacunas compradas</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12" id="alertas">
          </div>
        </div>
        <form id="frm-new">
        <div class="row">
          <div class="col-md-3" >
          </div>
          <div class="col-md-6">
            <label>Descripcion</label>
            <input type="text" name="detalle" id="txt-des" class="form-control">
          </div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn-guardar">Registrar</button>
      </div>
    </div>

  </div>
</div>

<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
        Collapsible Group 1</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
      <div class="panel-body">
        <div class="row">
  &nbsp;&nbsp;&nbsp;&nbsp;<label for="">Escriba la Cedula</label>
<input type="text" maxlength="15" name="codigomas" id="txt-buscar">
<button id="btn-buscar" name="buscar" class="btn btn-default">Buscar</button>


</div>

</div>


<div id="list-vacunas"></div>

    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        Collapsible Group 2</a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
        Collapsible Group 3</a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">
        <div id="historial_vacunas"></div></div>
    </div>
  </div>
</div>

<div class="responsive" id="reportems"></div>
<?php require_once '../app/contenido/foot.php'?>
<script src="../js/nueva_vacuna.js"></script>
<?php } else {
    header("location: ../");
}
?>
