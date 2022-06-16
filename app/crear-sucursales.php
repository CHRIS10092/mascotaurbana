<?php
session_start();
if (isset($_SESSION['usuario'])) {
?>
<?php include 'contenido/head.php'; ?>
<div class="col-md-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-4">
    <div class="widget-box ui-sortable-handle" id="widget-box-4">
        <div class="widget-header widget-header-large">
            <h4 class="widget-title">Listado de Sucursales</h4>

            <div class="widget-toolbar">
                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#n-usuario">
                    <i class="glyphicon glyphicon-plus"></i> Nuevo
                </button>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div id="correcto"></div>
                <div class="table-responsive" id="listado"></div>
            </div>
        </div>
    </div>
</div>





<!-- Modal -->
<div id="n-usuario" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="correcto"></div>
        <div class="col-md-12" id="alertas">
        </div>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nueva Sucursal</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                </div>
                <form id="frm-new-sucursales" enctype="multipart/form-data">
                    <h4>Datos de Sucursales</h4>
                    <div class="form-group row">
                        <label class="col-md-1 control-label">Id:</label>
                        <div class="col-md-3" id="inp-numero"></div>
                    </div>


                    <div class="form-group row">

                        <label class="col-md-1 control-label">Nombre Sucursal</label>
                        <div class="col-md-3">
                            <input type="text" name="sucu-nombre" id="txt-sucu-nombre" class="form-control input-sm">
                        </div>

                        <label class="col-md-1 control-label">Direccion Sucursal</label>
                        <div class="col-md-2">
                            <input type="text" name="sucu-direccion" id="txt-sucu-direccion"
                                class="form-control input-sm">

                        </div>
                        <label class="col-md-1 control-label">Telefono</label>
                        <div class="col-md-3">
                            <input type="text" name="sucu-telefono" id="txt-sucu-telefono" maxlength="10"
                                placeholder="09" class="form-control input-sm">
                            <div id="preview"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-1 control-label">Numero Estructura</label>
                        <div class="col-md-3">
                            <select name="sucu-numest" id="cmb-sucu-numest" class="form-control input-sm">
                                <option value="0">Seleccionar</option>
                                <option value="001">001</option>
                                <option value="002">002</option>
                                <option value="003">003</option>
                                <option value="004">004</option>
                                <option value="005">005</option>
                                <option value="006">006</option>
                            </select>
                        </div>
                        <label class="col-md-1 control-label">Numero de Factura</label>
                        <div class="col-md-2">
                            <select name="sucu-numfac" id="cmb-sucu-numfac" class="form-control input-sm">
                                <option value="0">Seleccionar</option>
                                <option value="001">001</option>
                                <option value="002">002</option>
                                <option value="001">003</option>
                                <option value="002">004</option>
                            </select>
                        </div>

                        <label class="col-md-1 control-label">Estado </label>

                        <div class="col-md-3">

                            <select name="sucu-estado" id="cmb-sucu-estado" class="form-control input-sm">
                                <option value="0">Seleccionar</option>
                                <option value="Act">Habilitada</option>
                                <option value="2">Inhabilitada</option>
                            </select>

                        </div>


                    </div>
                    <div class="form-group row">

                        <label class="col-md-1 control-label">sucursales</label>
                        <div class="col-md-3">

                            <div id="listadoempresas"> </div>

                        </div>

                    </div>


                    <style>
                    .campo {
                        position: relative;
                    }

                    .label1 {
                        width: 100%;
                    }

                    .input1 {
                        width: 100%;
                        padding: 7px;
                    }

                    .campo span {
                        position: absolute;
                        right: 5px;
                        top: 39px;
                        text-transform: uppercase;
                        cursor: pointer;
                        padding: 2px 10px;
                        background-color: #dadada;
                    }
                    </style>
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
<div id="mVersucursales" class="modal fade" role="dialog">
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
    <div class="modal-dialog modal-lg">
        <div id="correcto"></div>
        <div class="row">
            <div class="col-md-12" id="alertasu">
            </div>
        </div>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editar sucursal</h4>
            </div>
            <div class="modal-body">

                <form id="frm-edit-sucursales" enctype="multipart/form-data">
                    <div class="row">


                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="sucu-numerou" disable id="txt-sucu-numerou"
                            class="form-control input-sm">
                        <label class="col-md-1 control-label">Nombre Sucursal</label>
                        <div class="col-md-3">
                            <input type="text" name="sucu-nombreu" id="txt-sucu-nombreu" class="form-control input-sm">
                        </div>

                        <label class="col-md-1 control-label">Direccion Sucursal</label>
                        <div class="col-md-2">
                            <input type="text" name="sucu-direccionu" id="txt-sucu-direccionu"
                                class="form-control input-sm">

                        </div>
                        <label class="col-md-1 control-label">Telefono</label>
                        <div class="col-md-3">
                            <input type="text" name="sucu-telefonou" maxlength="10" placeholder="(09)"
                                id="txt-sucu-telefonou" class="form-control input-sm">
                            <div id="preview"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-1 control-label">Numero Estructura</label>
                        <div class="col-md-3">
                            <select name="sucu-numestu" id="cmb-sucu-numestu" class="form-control input-sm">
                                <option value="0">Seleccionar</option>
                                <option value="0">Seleccionar</option>
                                <option value="001">001</option>
                                <option value="002">002</option>
                                <option value="003">003</option>
                                <option value="004">004</option>

                            </select>
                        </div>
                        <label class="col-md-1 control-label">Numero de Factura</label>
                        <div class="col-md-2">
                            <select name="sucu-numfacu" id="cmb-sucu-numfacu" class="form-control input-sm">
                                <option value="0">Seleccionar</option>
                                <option value="001">001</option>
                                <option value="002">002</option>
                                <option value="003">003</option>
                                <option value="004">004</option>

                            </select>
                        </div>

                        <label class="col-md-1 control-label">Estado </label>

                        <div class="col-md-3">

                            <select name="sucu-estadou" id="cmb-sucu-estadou" class="form-control input-sm">
                                <option value="0">Seleccionar</option>
                                <option value="Act">Habilitada</option>
                                <option value="2">Inhabilitada</option>
                            </select>

                        </div>


                    </div>
                    <div class="form-group row">

                        <label class="col-md-1 control-label">Empresas</label>
                        <div class="col-md-3">

                            <div id="listadoempresasu"> </div>

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




<?php include 'contenido/foot.php'; ?>
<script src="../js/crear-sucursales.js"></script>
<?php } else {
  header("location: ../");
}
?>