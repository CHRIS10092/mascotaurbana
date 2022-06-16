<?php
session_start();
if (isset($_SESSION['usuario'])) {
?>
<?php include 'contenido/head.php'; ?>
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
                <div class="table-responsive" id="listado"></div>
            </div>
        </div>
    </div>
</div>





<!-- Modal permisos-->

<div id="n-habilitar" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div id="correcto"></div>
        <div class="col-md-12" id="alertas">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Habilitar o Deshbilitar</h4>
                </div>
                <div class="modal-body">
                    <div class="row">

                    </div>
                </div>
                <form id="frm-edit-empresas1">
                    <div class="row" style="padding-left: 22px;padding-right: 22px;">
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>Empresa</label>
                                <input type="text" readonly="" name="emp-idu" id="txt-emp-idu"
                                    class="form-control input-sm"><BR>
                            </div>
                            <div class="col-md-4">
                                <label>Estado de Empresa</label>
                                <select name="emp-estadou" id="cmb-emp-estadou" class="form-control">
                                    <option value="0">Seleccionar</option>
                                    <option value="1">Habilitada</option>
                                    <option value="2">Inhabilitada</option>
                                </select>
                                <BR>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn-guardarper">Registrar </button>
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
                <h4 class="modal-title">Nueva Empresa</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                </div>
                <form id="frm-new-empresas" enctype="multipart/form-data">
                    <h4>Datos de Empresa</h4>
                    <div class="form-group row">
                        <label class="col-md-1 control-label">Id:</label>
                        <div class="col-md-3" id="inp-numero"></div>


                    </div>


                    <div class="form-group row">

                        <label class="col-md-1 control-label">Nombre</label>
                        <div class="col-md-3">
                            <input type="text" name="emp-nombre" id="txt-emp-nombre" maxlength="30"
                                class="form-control input-sm">
                        </div>

                        <label class="col-md-1 control-label">Ruc</label>
                        <div class="col-md-2">
                            <input type="text" name="emp-ruc" id="txt-emp-ruc" maxlength="13"
                                class="form-control input-sm">

                        </div>
                        <label class="col-md-1 control-label">Logo</label>
                        <div class="col-md-3">
                            <input type="file" name="img" id="txt-img" class="form-control input-sm">
                            <div id="preview"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-1 control-label">Correo</label>
                        <div class="col-md-3">
                            <input type="text" name="emp-correo" id="txt-emp-correo" maxlength="100"
                                class="form-control input-sm">

                        </div>
                        <label class="col-md-1 control-label">Celular</label>
                        <div class="col-md-2">
                            <input type="text" name="emp-celular" id="txt-emp-celular" maxlength="10" placeholder="09"
                                class="form-control input-sm">
                        </div>

                        <label class="col-md-1 control-label">Estado </label>

                        <div class="col-md-3">

                            <select name="emp-estado" id="cmb-emp-estado" class="form-control input-sm">
                                <option value="0">Seleccionar</option>
                                <option value="1">Habilitada</option>
                                <option value="2">Inhabilitada</option>
                            </select>

                        </div>


                    </div>

                    <div class="form-group row">
                        <label class="col-md-1 control-label">Provincia</label>
                        <div class="col-md-3">
                            <input type="text" name="provincia" id="txt-provincia" maxlength="30"
                                class="form-control input-sm">

                        </div>
                        <label class="col-md-1 control-label">Canton</label>
                        <div class="col-md-2">
                            <input type="text" name="canton" id="txt-canton" maxlength="40"
                                class="form-control input-sm">
                        </div>
                        <label class="col-md-1 control-label">Parroquia</label>
                        <div class="col-md-3">
                            <input type="text" name="parroquia" id="txt-parroquia" maxlength="40"
                                class="form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 control-label">Direccion</label>
                        <div class="col-md-3">
                            <input type="text" name="emp-direccion" id="txt-emp-direccion" maxlength="200"
                                class="form-control input-sm">
                        </div>
                        <label class="col-md-1 control-label">Calle </label>
                        <div class="col-md-2">
                            <input type="text" name="emp-calleprincipal" placeholder="Principal" maxlength="100"
                                id="txt-emp-calleprincipal" class="form-control input-sm">

                        </div>
                        <label class="col-md-1 control-label">Calle S </label>
                        <div class="col-md-3">
                            <input type="text" name="emp-callesecundaria" id="txt-emp-callesecundaria" maxlength="200"
                                placeholder="Secundaria" class="form-control input-sm">
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-md-1 control-label">Referencia </label>
                        <div class="col-md-3">
                            <input type="text" name="emp-referencia" placeholder="Oficina" maxlength="200"
                                id="txt-emp-referencia" class="form-control input-sm">

                        </div>
                        <label class="col-md-1 control-label">Numero Oficina </label>
                        <div class="col-md-2">
                            <input type="text" name="emp-numerooficina" placeholder="ejemplo Oe-12" maxlength="20"
                                id="txt-emp-numerooficina" class="form-control input-sm">
                        </div>


                        <label class="col-md-1 control-label">Tipo Empresa </label>

                        <div class="col-md-3" id="tipoempresa" class="form-control input-sm"></div>

                    </div>

                    <div class="form-group row">
                        <label class="col-md-1 control-label" for="txtRutaFirma">Cargar (Archivo P.12) </label>
                        <div class="col-md-3">
                            <input type="file" id="txtRutaFirma" name="ruta-firma" class="form-control input-sm">

                        </div>
                        <label class="col-md-1 control-label">Contrasenia (Archivo P.12)</label>
                        <div class="col-md-2">
                            <input type="text" id="txtContrasenaFirma" name="contrasena-firma"
                                class="form-control input-sm">
                        </div>


                        <label class="col-md-1 control-label">Ambiente </label>

                        <div class="col-md-3" id="tipoambiente" class="form-control input-sm"></div>

                    </div>

                    <h4>Datos de Usuario</h4>
                    <div class="form-group row">

                        <label class="col-md-1 control-label">Primer </label>
                        <div class="col-md-3">
                            <input type="text" name="usu-nombreprimer" id="txt-usu-nombreprimer" maxlength="20"
                                placeholder="Nombre" class="form-control input-sm">
                        </div>

                        <label class="col-md-1 control-label">Segundo </label>
                        <div class="col-md-2">
                            <input type="text" name="usu-segundonombre" id="txt-usu-segundonombre" maxlength="20"
                                placeholder="Nombre" class="form-control input-sm">

                        </div>

                        <label class="col-md-1 control-label">Apellido </label>
                        <div class="col-md-3">
                            <input type="text" name="usu-apellidopaterno" id="txt-usu-apellidopaterno" maxlength="20"
                                placeholder="Paterno" class="form-control input-sm"
                                onkeypress="return solo_letras(event)">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-md-1 control-label">Apellido</label>
                        <div class="col-md-3">
                            <input type="text" name="usu-apellidomaterno" id="txt-apellidomaterno" maxlength="20"
                                class="form-control input-sm">
                        </div>

                        <label class="col-md-1 control-label">Direccion</label>
                        <div class="col-md-2">
                            <input type="text" name="usu-direccion" id="txt-usu-direccion" maxlength="20"
                                class="form-control input-sm">

                        </div>

                        <label class="col-md-1 control-label">Celular</label>
                        <div class="col-md-3">
                            <input type="text" name="usu-celular" id="txt-usu-celular" maxlength="20"
                                class="form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 control-label">Correo</label>
                        <div class="col-md-3">
                            <input type="text" name="usu-correo" id="txt-usu-correo" maxlength="50"
                                class="form-control input-sm">
                        </div>

                        <label class="col-md-2 control-label">Repita Correo</label>
                        <div class="col-md-3">
                            <input type="text" name="usu-correo-rep" id="txt-usu-correo-rep" maxlength="50"
                                class="form-control input-sm">

                        </div>


                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 control-label">Usuario</label>
                        <div class="col-md-2">
                            <input type="text" name="usu-usuario" id="txt-usu-usuario" maxlength="20"
                                class="form-control input-sm">
                        </div>
                        <label class="col-md-1 control-label">Contraseña</label>
                        <div class="col-md-3">
                            <input type="text" name="usu-contrasenia" id="txt-usu-contrasenia" maxlength="20"
                                class="form-control input-sm">
                        </div>

                        <label for="password" class="col-md-1 control-label" style="position: relative;">Repita
                            Contraseña</label>
                        <div class="campo col-md-3">
                            <input type="password" style=" width: 100%; padding: 7px;" maxlength="20"
                                name="usu-contrasenia-rep" id="txt-usu-contrasenia-rep" class="form-control input-sm">
                            <span style="

    position: absolute;
    right: 10px;
    top: 0px;
    text-transform: uppercase;
    cursor: pointer;
    padding: 3px 0px;
    background-color: #dadada;">Mostrar</span>
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
<div id="mVerEmpresa" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div id="ver-orden"></div>
            </div>
        </div>

    </div>
</div>

<!-- detallar <div>-->
<div id="mVerSucursal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div id="ver-sucursal"></div>
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
                <h4 class="modal-title">Editar Empresa</h4>
            </div>
            <div class="modal-body">

                <form id="frm-edit-empresas" enctype="multipart/form-data">
                    <div class="row">


                    </div>
                    <div class="form-group row">

                        <input type="hidden" name="emp-idu1" id="txt-emp-idu1" class="form-control input-sm">
                        <label class="col-md-1 control-label">Ruc</label>
                        <div class="col-md-3">
                            <input type="text" name="emp-rucu" id="txt-emp-rucu" class="form-control input-sm">
                        </div>
                        <label class="col-md-1 control-label"> Empresa</label>
                        <div class="col-md-2">
                            <input type="text" name="emp-nombreu" id="txt-emp-nombreu" class="form-control input-sm">
                        </div>

                        <label class="col-md-1 control-label">Correo</label>
                        <div class="col-md-3">
                            <input type="text" name="emp-correou" id="txt-emp-correou" class="form-control input-sm">
                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 control-label">Direccion</label>
                        <div class="col-md-3">
                            <input type="text" name="emp-direccionu" id="txt-emp-direccionu"
                                class="form-control input-sm">
                        </div>
                        <label class="col-md-1 control-label">Telefono</label>
                        <div class="col-md-2">
                            <input type="text" name="emp-telefonou" maxlength="10" id="txt-emp-telefonou"
                                class="form-control input-sm">
                        </div>
                        <label class="col-md-1 control-label">Tipo Empresa</label>

                        <div class="col-md-3" id="tipoempresaub"></div>


                    </div>
                    <div class="form-group row">
                        <label class="col-md-1 control-label" for="txtRutaFirmau">Ver (Archivo P.12) </label>
                        <div class="col-md-3">
                            <input type="text" id="txtRutaFirmau" name="ruta-firmau" class="form-control input-sm"
                                disabled="">

                        </div>
                        <label class="col-md-1 control-label" for="txtRutaFirmaun">Cargar (Archivo P.12) </label>
                        <div class="col-md-2">
                            <input type="file" id="txtRutaFirmaun" name="ruta-firmaun" class="form-control input-sm">

                        </div>
                        <label class="col-md-1 control-label">Contrasenia (Archivo P.12)</label>
                        <div class="col-md-3">
                            <input type="text" id="txtContrasenaFirmau" name="contrasena-firmau"
                                class="form-control input-sm">
                        </div>



                    </div>
                    <div class="form-group row">
                        <label class="col-md-1 control-label">Ambiente </label>

                        <div class="col-md-3" id="tipoambienteu" class="form-control input-sm"></div>
                    </div>

                    <div class="form-group row">


                        <h3>Foto Actual</h3>
                        <div class="col-md-3">
                            <input type="hidden" class="form-control input-sm" id="txtFoto" name="Foto">
                            <img width="180px" height="150px" id="imgArticulo">
                        </div>

                        <h3>Cargar Nueva Foto</h3>
                        <div class="col-md-3">
                            <input type="file" id="txt-imagen" width="30px" heigth="30px" class="form-control input-sm"
                                name="imagen">
                            <div id="preview1"> </div>

                        </div>
                    </div>



                    <div class="form-group row">
                        <label class="col-md-1 control-label">Provincia</label>
                        <div class="col-md-3">
                            <input type="text" name="emp-provinciau" id="txt-emp-provinciau"
                                class="form-control input-sm">

                        </div>
                        <label class="col-md-1 control-label">Canton</label>
                        <div class="col-md-2">
                            <input type="text" name="emp-cantonu" id="txt-emp-cantonu" class="form-control input-sm">
                        </div>
                        <label class="col-md-1 control-label">Parroquia</label>
                        <div class="col-md-3">
                            <input type="text" name="emp-parroquiau" id="txt-emp-parroquiau"
                                class="form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-1 control-label">Calle </label>
                        <div class="col-md-3">
                            <input type="text" name="emp-calleprincipalu" placeholder="Principal"
                                id="txt-emp-calleprincipalu" class="form-control input-sm">

                        </div>
                        <label class="col-md-1 control-label">Calle </label>
                        <div class="col-md-2">
                            <input type="text" name="emp-callesecundariau" id="txt-emp-callesecundariau"
                                placeholder="Secundaria" class="form-control input-sm">
                        </div>
                        <label class="col-md-1 control-label">Numero Oficina </label>
                        <div class="col-md-3">
                            <input type="text" name="emp-numerooficinau" placeholder="ejemplo Oe-12"
                                id="txt-emp-numerooficinau" class="form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-1 control-label">Referencia </label>
                        <div class="col-md-3">
                            <input type="text" name="emp-referenciau" placeholder="Oficina" id="txt-emp-referenciau"
                                class="form-control input-sm">

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
<script src="../js/crear-empresa.js"></script>
<?php } else {
  header("location: ../");
}
?>