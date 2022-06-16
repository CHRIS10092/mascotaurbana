<?php
session_start();

if (isset($_SESSION['usuario'])) {

    ?>
<?php include 'contenido/head.php';?>
<div class="col-md-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-4">
    <div class="widget-box ui-sortable-handle" id="widget-box-4">
        <div class="widget-header widget-header-large">
            <h4 class="widget-title">Listado de Tenedores</h4>

            <!--<div class="widget-toolbar">
                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#m-tenedor">
                    <i class="glyphicon glyphicon-plus"></i> Nuevo
                </button>
            </div>-->
        </div>
        <div class="widget-body">
            <div class="widget-main">
                <div id="correcto"></div>
                <div id="listadoadmin"></div>
            </div>
        </div>


    </div>
</div>
<!-- MODAL PARA REGISTRAR TENEDOR -->
<div id="m-tenedor" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registrar Tenedor</h4>

            </div>
            <div class="modal-body">
                <div class="widget-main">
                    <div class="row">
                        <div class="col-md-12" id="alertas"></div>
                        <div id="correcto"></div>
                    </div>

                <form id="frm-tenedor"  enctype="multipart/form-data">
                    <h4>Datos Personales </h4>
                    <div class="row">

                        <div class="col-md-2">
                             <input type="hidden"  id="txt-ten-session" name="ten-session"  value="<?=$_SESSION['usuario'][6];?>" class="form-control">
                            <label for="">Cedula</label>
                            <input type="text"  id="txt-ten-cedula" name="ten-cedula" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Primer Nombre </label>
                            <input type="text" id="txt-ten-nombre-p" name="ten-nombre-p" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Segundo Nombre </label>
                            <input type="text" id="txt-ten-nombre-s" name="ten-nombre-s" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Primer Apellido</label>
                            <input type="text" id="txt-ten-apellido-p" name="ten-apellido-p" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Segundo Apellido</label>
                            <input type="text" id="txt-ten-apellido-s" name="ten-apellido-s" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">fecha nacimiento</label>
                            <input type="date" id="txt-ten-fecha" name="ten-fecha" class="form-control">
                        </div>
                    </div>
                    <hr>

                    <h4>Datos de Información</h4>
                    <div class="row">

                        <div class="col-md-4">
                            <label for="">Correo</label>
                            <input type="email" id="txt-ten-correo" name="ten-correo" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Celular</label>
                            <input type="text" id="txt-ten-celular"  name="ten-celular" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Provincia</label>
                            <div id="provincias"> </div>
                        </div>


                        <div class="col-md-2">
                            <label for="">Canton</label>
                             <div id="cantones">

                             </div>
                        </div>

                    </div>
                            <h>
                              <br>
                    <div class="row">

                              <div class="col-md-2">
                            <label for="">Parroquia</label>
                           <div id="parroquias"></div>
                        </div>
                            <div class="col-md-2">
                            <label for="">Barrio</label>
                            <input type="text" id="txt-ten-barrio" name="ten-barrio" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Calle Principal</label>
                            <input type="text" id="txt-ten-calleprincial" name="ten-calleprincial" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for=""> Numero Casa</label>
                            <input type="text" id="txt-ten-numerocasa" name="ten-numerocasa" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Calle Secundaria</label>
                            <input type="text" id="txt-ten-callesecundaria" name="ten-callesecundaria" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Refencia Casa</label>
                            <input type="text" id="txt-ten-referencia" name="ten-referencia" class="form-control">
                        </div>

                        <div class="col-md-4">



                         <label for="">Foto</label>
                            <input type="file" id="txt-img" name="img" class="form-control">
                            <div style="width: 50px  " id="preview">  </div>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button"  class="btn btn-primary" id="btn-registrar">Registrar</button>
            </div>
        </div>

    </div>

</div>
</div>

<div id="m-tenedoru" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

         <!-- Modal content-->
<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editar Tenedor</h4>
            </div>
    <div class="modal-body">
                <div class="widget-main">
                    <div class="row">
                        <div class="col-md-12" id="alertas">
                        </div>
                        <div id="correcto"></div>
                    </div>



 <form id="frm-edit-tenedor"  enctype="multipart/form-data" >
                    <h3>editar </h3>
                    <div class="row">

                        <div class="col-md-2">
                             <input type="hidden"  id="txt-sessionu" name="sessionu"  value="<?=$_SESSION['usuario'][6];?>" class="form-control">
                            <input type="hidden"  id="txt-codigou" readonly="" name="codigou" class="form-control">
                            <label for="">Cedula</label>
                            <input type="text"  id="txt-cedulau" readonly="" name="cedulau" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Primer Nombre </label>
                            <input type="text" id="txt-nombre-pu" name="nombre-pu" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Segundo Nombre </label>
                            <input type="text" id="txt-nombre-su" name="nombre-su" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Primer Apellido</label>
                            <input type="text" id="txt-apellido-pu" name="apellido-pu" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Segundo Apellido</label>
                            <input type="text" id="txt-apellido-su" name="apellido-su" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">fecha nacimiento</label>
                            <input type="date" id="txt-fechau" name="fechau" class="form-control">
                        </div>
                    </div>
                    <hr>

                    <h4>Datos de Información</h4>
                    <div class="row">

                        <div class="col-md-4">
                            <label for="">Correo</label>
                            <input type="email" id="txt-correou" name="correou" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Celular</label>
                            <input type="text" id="txt-celularu"  name="celularu" class="form-control">
                        </div>

                          <div class="col-md-2">
                            <label for="">Provincia</label>
                            <div id="provinciasu"> </div>
                        </div>


                        <div class="col-md-2">
                            <label for="">Canton</label>
                             <div id="cantonesu">

                             </div>
                        </div>


                    </div>
                            <h></h>
                              <br>
                    <div class="row">

                            <div class="col-md-2">
                            <label for="">Parroquias</label>
                             <div id="parroquiasu">

                             </div>
                        </div>

                            <div class="col-md-2">
                            <label for="">Barrio</label>
                            <input type="text" id="txt-barriou" name="barriou" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Calle Principal</label>
                            <input type="text" id="txt-calleprincialu" name="calleprincialu" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for=""> Numero Casa</label>
                            <input type="text" id="txt-numerocasau" name="numerocasau" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Calle Secundaria</label>
                            <input type="text" id="txt-callesecundariau" name="callesecundariau" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Refencia Casa</label>
                            <input type="text" id="txt-referenciau" name="referenciau" class="form-control">
                        </div>

                        <div class="col-md-4">


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

        <input type="hidden" name="sessionu" value="<?php echo $_SESSION['usuario'][6] ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn-editar">Editar</button>
            </div>
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


<?php include 'contenido/foot.php';?>
<script src="../js/tenedoradmin.js"></script>
<?php } else {
    header("location: ../");
}
?>