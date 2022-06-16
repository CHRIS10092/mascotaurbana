<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>
<?php include 'contenido/head.php';?>
<div class="col-md-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-4">
  <div class="widget-box ui-sortable-handle" id="widget-box-4">
    <div class="widget-header widget-header-large">
      <h4 class="widget-title">Listado de Empresas</h4>

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
     <div id="correcto"></div>
<div class="col-md-12" id="alertas">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nuevo Permiso</h4>
      </div>
      <div class="modal-body">
        <div class="row">

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
     <div id="correcto"></div>
    <div class="col-md-12" id="alertas">
          </div>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nueva Empresa</h4>
      </div>
      <div class="modal-body">
        <div class="row">

        </div>
        <form id="frm-new-empresas" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-3" >
          </div>
          <div class="col-md-6">


            <label>Ruc</label>
            <input type="text" name="ruc" id="txt-ruc" onblur="validarDocumento()" placeholder="debe escribir 001 al final" class="form-control">
            <label>Nombre Empresa</label>
            <input type="text" name="empresa" id="txt-empresa" class="form-control">
            <label>Correo Empresa</label>
            <input type="text" name="correo" id="txt-correo" class="form-control">
            <label>Direccion Empresa</label>
            <input type="text" name="direccion" id="txt-direccion" class="form-control">
            <label>Celular Empresa</label>
            <input type="text" name="telefono" id="txt-telefono" maxlength="10" class="form-control">
            <div style="width: 50px  " id="preview">  </div>
            <label for="">Foto</label>
            <input type="file" id="txt-img" name="img" class="form-control">
            <label>Tipo de Empresa</label>
            <div id="tipoempresa"></div>
            <label> Nombres Completos  </label>
            <input type="text" name="nombreres" id="txt-nombreres" class="form-control">
            <label> Usuario </label>
            <input type="text" name="nombreusu" id="txt-nombreusu" placeholder="" class="form-control">
            <label> Contraseña </label>
            <input type="password" name="nombrepass" id="txt-nombrepass" class="form-control">
            <label>Correo de  Contacto</label>
            <input type="text" name="correores" id="txt-correores"   placeholder="ejemplo@ejemplo.com"  class="form-control">
            <label>Direccion de Contacto</label>
            <input type="text" name="direccionres" id="txt-direccionres" class="form-control">
            <label>Celular Contacto</label>
            <input type="text" name="telefonores" id="txt-telefonores" maxlength="10" placeholder="(09)" class="form-control">




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

<div id="n-usuariou" class="modal fade" role="dialog">
  <div class="modal-dialog">
 <div id="correcto"></div>
 <div class="row">
          <div class="col-md-12" id="alertasu">
          </div>
        </div>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Empresa</h4>
      </div>
      <div class="modal-body">

        <form id="frm-edit-empresas"  enctype="multipart/form-data" >
        <div class="row">
          <div class="col-md-3" >
          </div>
          <div class="col-md-6">

            <input type="hidden" name="idu" id="txt-idu" class="form-control">
            <label>Ruc</label>
            <input type="text" name="rucu" id="txt-rucu" class="form-control">
            <label>Nombre Empresa</label>
            <input type="text" name="empresau" id="txt-empresau" class="form-control">
            <label>Correo</label>
            <input type="text" name="correou" id="txt-correou" class="form-control">
            <label>Direccion</label>
            <input type="text" name="direccionu" id="txt-direccionu" class="form-control">
            <label>Telefono</label>
            <input type="text" name="telefonou" id="txt-telefonou" class="form-control">
              <label>Tipo de Empresa</label>
            <div id="tipoempresaub"></div>
             <div class="col-md-4">

            <div>
                        <h3>Foto Actual</h3>
                        <input type="hidden" id="txtFoto" name="Foto">
                        <img width="180px" height="150px" id="imgArticulo" >
            </div>
                         <div class="col-md-4">
                        <h3>Cargar Nueva Foto</h3>
                        <input type="file" id="txt-imagen" name="imagen">
                        <div id="preview1"> </div>

                        </div>

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
<script src="../js/empresas.js"></script>
<?php } else {
    header("location: ../");
}
?>