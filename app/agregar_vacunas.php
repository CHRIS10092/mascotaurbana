<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>
<?php include 'contenido/head.php';?>

<div class="col-md-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-4">
    <div class="widget-box ui-sortable-handle" id="widget-box-4">
        <div class="widget-header widget-header-large">
            <h4 class="widget-title">Listado de Tipos de Vacunas</h4>

            <div class="widget-toolbar">
                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#n-vacunas">
                    <i class="glyphicon glyphicon-plus"></i> Nuevo
                </button>
            </div>
        </div>



    </div>

 <div id="listadovacunas" class="table table-responsive"></div>



<!-- Modal -->
<div id="n-vacunas" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nueva Vacuna</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-12" id="alertas">
      		</div>
      	</div>
        <form id="frm-new">
      	<div class="row">

      		<div class="col-md-6">
      			<label>Descripcion</label>
      			<input type="text" name="descripcion" id="txt-descripcion" class="form-control">
      		</div>
      		<div class="col-md-6">
      			<label>Tipo de Vacunas</label>
      			<div id="listar-tipov"></div>
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

<!-- Modal -->
<div id="n-vacunasu" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Vacuna</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-12" id="alertas">
      		</div>
      	</div>
        <form id="frm-edit">
      	<div class="row">

      		<div class="col-md-6">


      				<input type="text" readonly="" name="codigou" id="txt-codigou">
      				<br>


      			<label>Descripcion</label>
      			<input type="text" name="descripcionu" id="txt-descripcionu" class="form-control" >

      			<br>
      			<label>Tipo de Vacunas</label>
      			<div id="listar-tipovu"></div>
      		</div>
      	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn-editar">Editar</button>
      </div>
    </div>

  </div>
</div>





<?php require_once '../app/contenido/foot.php'?>
<script src="../js/vacunas.js"></script>
<?php } else {
    header("location: ../");
}
?>