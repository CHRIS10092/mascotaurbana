<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>
<?php include 'contenido/head.php';?>
<div class="col-md-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-4">
    <div class="widget-box ui-sortable-handle" id="widget-box-4">
       <div class="widget-header widget-header-large">
            <h4 class="widget-title">Listado de Tenedores</h4>

            <div class="widget-toolbar">
                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#m-clientes">
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
<div id="m-clientes" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registrar Tenedor</h4>
            </div>
            <div class="modal-body">

                <form id="frm-cliente">
                    <div class="row">

                        <div class="col-md-2">
                            <label for="">Cedula</label>
                            <input type="text"  id="txtCedula" name="cedula" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-md-4">
                            <label for="">Nombre</label>
                            <input type="text" id="txt-nombre" name="nombre" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Apellido</label>
                            <input type="text" id="txt-apellido" name="apellido" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">fecha nacimiento</label>
                            <input type="date" id="txt-fecha" name="nacimiento" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-md-4">
                            <label for="">Correo</label>
                            <input type="email" id="txt-correo" name="correo" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Celular</label>
                            <input type="text" id="txt-celular"  name="celular" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Ciudad</label>
                            <input type="text" id="txt-ciudad" name="ciudad" class="form-control">
                        </div>
                         <div class="col-md-4">
                            <label for="">Direccion</label>
                            <input type="text" id="txt-dirrecion" name="direccion" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">

                         <label for="">Foto</label>
                            <input type="file" id="txt-foto" name="foto" class="form-control">

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
<div id="m-clientesu" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editar Cliente</h4>
            </div>
            <div class="modal-body">

                <form id="frm-edit-cliente">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <label for="">Cedula</label>
                            <input type="text" readOnly id="txtCedula" name="cedulau" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-md-4">
                            <label for="">Nombre</label>
                            <input type="text" id="txt-nombre" name="nombreu" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Apellido</label>
                            <input type="text" id="txt-apellido" name="apellidou" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">fecha nacimiento</label>
                            <input type="date" id="txt-fecha" name="nacimientou" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-md-4">
                            <label for="">Correo</label>
                            <input type="email" id="txt-correo" name="correou" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Celular</label>
                            <input type="text" id="txt-celular"  name="celularu" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Ciudad</label>
                            <input type="text" id="txt-ciudad" name="ciudadu" class="form-control">
                        </div>
                         <div class="col-md-4">
                            <label for="">Direccion</label>
                            <input type="text" id="txt-dirrecion" name="direccionu" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">

                         <label for="">Foto</label>
                            <input type="file" id="txt-foto" name="fotou" class="form-control">

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
<script src="../js/tenedor.js"></script>
<?php } else {
    header("location: ../");
}
?>