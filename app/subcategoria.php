<?php 
session_start();
if (isset($_SESSION['usuario'])) {
 ?>
<?php include 'contenido/head.php';?>
<div class="col-md-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-4">
	<div class="widget-box ui-sortable-handle" id="widget-box-4">
		<div class="widget-header widget-header-large">
			<h4 class="widget-title">Listado de Subcategorias</h4>

			<div class="widget-toolbar">
				<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#n-subcategoria">
					<i class="glyphicon glyphicon-plus"></i> Nuevo
				</button>
			</div>
		</div>

		<div class="widget-body">
			<div class="widget-main">
        <div id="correcto"></div>
				<div id="listado"></div>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div id="n-subcategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nueva Subcategoria</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-12" id="alertas">
      		</div>
      	</div>
      	<div class="row">
      		<div class="col-md-3" >
      		</div>
      		<div class="col-md-6">
            <form id="frm-new">
            <label>Categoria</label>
            <div id="list-categoria"></div>
      			<label>Descripcion</label>
      			<input type="text" name="detalle" id="txt-des" class="form-control" onkeypress="return solo_letras(event)">
            </form>
      		</div>
      	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn-guardar">Registrar</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="n-subcategoriau" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Subcategoria</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12" id="alertasu">
          </div>
        </div>
        <div class="row">
          <div class="col-md-3" >
          </div>
          <div class="col-md-6">
            <form id="frm-edit">
            <input type="hidden" id="txt-id" name="id">
            <label>Categoria</label>
            <div id="list-categoriau"></div>
            <label>Descripcion</label>
            <input type="text" name="detalle" id="txt-desu" class="form-control" onkeypress="return solo_letras(event)">
            </form>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn-editar">Editar</button>
      </div>
    </div>

  </div>
</div>
<?php include 'contenido/foot.php';?>
<script src="../js/subcategoria.js"></script>
<?php } else {
    header("location: ../");
}
?>
