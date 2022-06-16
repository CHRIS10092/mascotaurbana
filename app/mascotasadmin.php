<?php
session_start();
require_once "../app/contenido/head.php";
?>


<div class="row">
  <div class="col-md-12">
    <div class="box box-success">
      <!-- /.box-header -->
      <div class="box-body">

        <div class="alert alert-success alert-dismissible">
          <center><h4><i class="icon fa fa-paw"></i> Listado General de Mascotas </h4></center>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>


<div id="listadomadmin">

</div>

<!-- Modal editar mascotas -->
<div class="modal fade" id="m-mascotasu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="exampleModalLabel">Editar Mascota</h4>
      </div>
      <div class="modal-body">
       <form id="frm-mascotau" enctype="multipart/form-data">

 <div class="col-md-4">
  <div id="correcto"></div>
  <div id="alertas"></div>
                           <input type="hidden" name="id" id="txt-id">
                          <label>Codigo Principal</label>
                          <input type="text" id="txt-codigo" name="codigo" readonly="" style="border-radius: 2px;" placeholder="INGRESAR 14 NUMEROS" class="form-control" id="txt-codigo" maxlength="13" class="form-control input-sm">

                          <label>Nombre Mascota</label>
                          <input type="text" name="nombre"  id="txt-nombre" class="form-control">
                          <label for="txt-sexo">Sexo</label>
                          <br>
                          <select name="cmbsexo" id="cmb-sexo" class="form-control ">
                            <option value="0">Seleccionar</option>
                            <option value="Macho">Macho</option>
                            <option value="Hembra">Hembra</option>
                          </select>

                          <label >Fecha de Nac</label>
                          <input type="date" name="fecha" id="txt-fecha" class="form-control "><br>

                        </div>
                        <div class="row">
                        <div class="col-md-3">

                          <label >color</label>
                          <input type="text" name="color" id="txt-color" class="form-control "><br>
                          <label >color 1</label>
                          <input type="text" name="color1" id="txt-color1" class="form-control "><br>

                          <br>
                          <label >Tipo Mascota</label>
                          <div id="especies"></div>
                          <br>
                          <label >Tipo Razas</label>
                          <div id="razas"></div>
                          <br>
                        </div>
                        <div class="col-md-4">

                          <label>Esterelizado</label>
                            <select name="cmb-esterelizado" id="cmb-esterelizado" class="form-control">
                            <option value="0">Seleccionar</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                          </select>
                          <label>Tenedor</label>
                            <div id="tenedor"></div>


                          <!--<input type="text" name="tenedor" readonly=""  id="txt-tenedor" class="form-control">-->
                           <h3>Foto Actual</h3>
                        <input type="hidden" id="txtFoto" name="Foto">
                        <img width="180px" height="150px" id="imgArticulo" >


                        <h3>Cargar Nueva Foto</h3>
                        <input type="file" id="txt-imagen" name="imagen">
                        <div id="preview"></div>
                          <br>

                        </div>
                      </div>

       </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn-editar" onclick="editarm();">Editar</button>
      </div>
    </div>
  </div>
</div>

<div id="mVerm" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div id="ver-orden"></div>
      </div>
    </div>

  </div>
</div>

<?php
require_once "../app/contenido/foot.php";
?>

 <script type="text/javascript" src="../js/editar-mascotaadmin.js"></script>
