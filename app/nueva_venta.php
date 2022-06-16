<?php
error_reporting(0);
session_start();
date_default_timezone_set('America/Lima');
if (isset($_SESSION['usuario'])) {
?>
<?php include 'contenido/head.php'; ?>

<br>
<form id="frm-registro" class="form-horizontal">
    <div class="form-group row">
        <label class="col-md-1 control-label">Fecha</label>
        <div class="col-md-3">
            <input type="text" name="fecha" class="form-control" value="<?php echo date('d-y-m') ?>" readonly="">

        </div>
        <label class="col-md-1 control-label">Venta</label>
        <div class="col-md-2">

            <div id="inp-numero"></div>
        </div>
        <label class="col-md-1 control-label">Agregar</label>
        <div class="col-md-3">
            <button class="btn btn-warning form-control" data-toggle="modal" onclick="recargar(event);"
                data-target="#n-medicamento">
                <i class="glyphicon glyphicon-search"></i> Buscar Articulo
            </button>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-1 control-label">Ruc</label>
        <div class="col-md-3">
            <input type="text" name="ruc" id="txt-ruc" onkeypress="return solo_numeros(event)"
                class="form-control input-sm">

        </div>
        <label class="col-md-1 control-label">Nombre</label>
        <div class="col-md-2">
            <input type="text" name="nombre" id="txt-nombre" class="form-control input-sm"
                onkeypress="return solo_letras(event)">
        </div>
        <label class="col-md-1 control-label">Apellido</label>
        <div class="col-md-3">
            <input type="text" name="apellido" id="txt-apellido" class="form-control input-sm"
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
            <input type="text" name="celular" id="txt-celular" class="form-control input-sm" maxlength="10"
                onkeypress="return solo_numeros(event)">
        </div>
        <input type="hidden" value="<?php echo $_SESSION['empresa']['idempresa'] ?>">
    </div>

    <div class="form-group row">
        <div id="list-detalle"></div>
    </div>
    <div class="pull-right">
        <button type="button" class="btn btn-primary" id="btn-guarda">Registrar</button>

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

        </div>

    </div>
</div>







<?php include 'contenido/foot.php'; ?>
<script src="../js/nueva_venta.js"></script>
<?php } else {
    header("location: ../");
}
?>