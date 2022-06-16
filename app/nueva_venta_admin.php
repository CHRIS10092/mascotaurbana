<?php
session_start();
date_default_timezone_set("America/Guayaquil");
$hora = date("Y-m-d");
if (isset($_SESSION['usuario'])) {
    ?>
    <?php include 'contenido/head.php';?>

    <form id="frm-registro">
        <div class="row">
            <div class="col-md-12">
                <div class="widget-box ui-sortable-handle">
                    <div class="widget-header widget-header" style="background:#478FCA!important">
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="alertas"></div>
                                    <div id="correcto"></div>
                                </div>
                            </div>
     <div class="form-group row">
     <label class="col-md-1 control-label">Fecha</label>
         <div class="col-md-2">
         <input type="text" name="fecha" class="form-control"
          value="<?php echo $hora ?>" readonly="">

        </div>
     <label class="col-md-1 control-label">Venta</label>
         <div class="col-md-3">

         <div id="inp-numero"></div>
        </div>

     </div>
     <div class="form-group row">

    <label class="col-md-1 control-label">Agregar</label>
         <div class="col-md-2">
          <button class="btn btn-success form-control" data-toggle="modal"
                                    onclick="recargar(event);" data-target="#n-medicamento">
                                    <i class="glyphicon glyphicon-search"></i> Agregar Producto
           </button>
      </div>
      <!--<label class="col-md-1 control-label">Seleccionar</label>-->
         <div class="col-md-3 control-label">
                          <span class="btn btn-primary pull-right" data-toggle="modal" data-target="#n-empresas">
                            Escoger Empresa <i class="glyphicon glyphicon-search"></i>
                          </span>
        </div>
     </div>


                        <br>


                                  <div class="form-group row">
     <label class="col-md-1 control-label">Ruc</label>
         <div class="col-md-3">
           <input type="text" name="ruc" id="txt-ruc" onkeypress="return solo_numeros(event)" class="form-control input-sm">

        </div>
     <label class="col-md-1 control-label">Nombre</label>
         <div class="col-md-2">
         <input type="text" name="nombre" id="txt-nombre"  class="form-control input-sm"   onkeypress="return solo_letras(event)">
        </div>
    <label class="col-md-1 control-label">Cod Empresa</label>
         <div class="col-md-3">
          <input type="text" name="id" id="txt-id" disabled class="form-control input-sm"
          onkeypress="return solo_letras(event)">
      </div>
     </div>



      <div class="form-group row">
     <label class="col-md-1 control-label">Direccion</label>
         <div class="col-md-3">
          <input type="text" name="direccion" id="txt-direccion" class="form-control input-sm">
        </div>
     <label class="col-md-1 control-label">Correo</label>
         <div class="col-md-2">
          <input type="text" name="correo" id="txt-correo" class="form-control input-sm">
        </div>
    <label class="col-md-1 control-label">Celular</label>
         <div class="col-md-3">
         <input type="text" name="celular" id="txt-celular" class="form-control input-sm" maxlength="10"  onkeypress="return solo_numeros(event)">
      </div>

     </div>

                                <div class="col-md-12">
                                    <br>

                                    <div id="list-detalle"></div>
                                    <button type="button" class="btn btn-primary" id="btn-guarda">Registrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </form>

<!-- Modal -->
<div id="n-medicamento" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Buscar Articulos</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="alertas1"></div>
                        <div id="list-medicamento"></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>
<div id="n-empresas" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Buscar Empresa</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="alertas1"></div>
                        <div id="list-empresas"></div>
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
<script src="../js/nueva_venta_admin.js"></script>
<?php } else {
    header("location: ../");
}
?>
