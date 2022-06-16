<?php 
session_start();
if (isset($_SESSION['usuario'])) {
 ?>
<?php include 'contenido/head.php';?>
<div class="col-md-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-4">
	<div class="widget-box ui-sortable-handle" id="widget-box-4">
		<div class="widget-header widget-header-large">
			<h4 class="widget-title">Listado de Usuarios</h4>

			<div class="widget-toolbar">
				<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#n-usuario">
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

<!-- Modal permisos-->

<div id="n-perfil" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nuevo Permiso</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12" id="alertas">
          </div>
        </div>
        <form id="frm-per">
        <div class="row">
          <div class="col-md-3" >
          </div>
          <div class="col-md-6">
            <label>Nombre  </label>
            <input type="text" name="nombre" readonly="" id="txt-nombrep" class="form-control">
            <label>Usuario </label>
            <input type="text" name="usuario" readonly="" id="txt-usuariop" class="form-control">
            <br>
            <div class="row">
            <div class="col-md-2">
              <label><strong>Zonas</strong></label>
              <div id="list-categoria"> </div>            
            </div>
            </div>
            <div class="row">
            <div class="col-md-2">
              <label><strong>Sub Zonas</strong></label>
              <div id="list-subcategoria"> </div>
            </div>
            </div>
            <input type="hidden"  name="id-usuario" readonly="" id="txt-id-usuario" class="form-control">

          </div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary"   id="btn-guardarper">Registrar Perfil</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="n-usuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nuevo Usuario</h4>
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
      			<label>Nombre Completo</label>
      			<input type="text" name="nombre" id="txt-nombre" class="form-control">
      			<label>Usuario</label>
      			<input type="text" name="usuario" id="txt-usuario" class="form-control">
      			<label>Email</label>
      			<input type="text" name="correo" id="txt-correo" class="form-control">
            <label>Direccion</label>
            <input type="text" name="direccion" id="txt-direccion" class="form-control">
      			<label>Rol de Usuario</label>
      			<div id="list-perfil"></div>

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

<div id="n-usuariou" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Usuario</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12" id="alertasu">
          </div>
        </div>
        <form id="frm-edit">
        <div class="row">
          <div class="col-md-3" >
          </div>
          <div class="col-md-6">
            <input type="hidden" name="id" id="txt-id">
            <label>Nombre Completo</label>
            <input type="text" name="nombre" id="txt-nombreu" class="form-control">
            <label>Usuario</label>
            <input type="text" name="usuario" id="txt-usuariou" class="form-control">
            <label>Email</label>
            <input type="text" name="correo" id="txt-correou" class="form-control">
            <label>Direccion</label>
            <input type="text" name="direccion" id="txt-direccionu" class="form-control">
            <label>Rol de Usuario</label>
            <div id="list-perfilu"></div>
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
<?php include 'contenido/foot.php';?>
<script src="../js/usuario.js"></script>
<?php } else {
    header("location: ../");
}
?>