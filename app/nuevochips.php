<?php
error_reporting(0);
session_start();
date_default_timezone_set('America/Lima');
if (isset($_SESSION['usuario'])) {
?>
<?php include 'contenido/head.php'; ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="alert alert-success alert-dismissible">
                    <center>
                        <h4><i class="icon fa fa-paw"></i> Listar Chips</h4>
                    </center>
                </div>
                <div class="pull-left">


                    <button id="registrarmascota" data-toggle="modal" data-target="#m-mascotas"
                        class="btn btn-primary btn-lg btn-block">Ingresar Chip</button>
                    <br>
                    <br>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

</div>

<div id="listado">

</div>

<!-- Modal Agregar Chips por empresa -->
<div class="modal fade" id="m-mascotas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Nuevo Chip</h4>
            </div>
            <div class="modal-body">
                <form id="frm-chips" enctype="multipart/form-data">

                    <div class="col-md-4">
                    
                    <label>Codigo Principal</label>
                        <input type="text" id="txt-codigo" name="codigo"  style="border-radius: 2px;"
                            placeholder="INGRESAR 15 NUMEROS" class="form-control" id="txt-codigo" maxlength="15"
                            class="form-control input-sm">
              
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                        <label>Estado de Chip</label>
                        <select name="cmbchip" id="cmb-chip" class="form-control ">
                            <option value="0">Seleccionar</option>
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                    
                        </select>
                        </div>
                       
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn-guardar" >Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal editar mascotas -->
<div class="modal fade" id="m-mascotasu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Editar Estado Chips</h4>
            </div>
            <div class="modal-body">
                <form id="frm-chipsu" enctype="multipart/form-data">

                    <div class="col-md-4">
                        
                    <input type="hidden" name="id" id="txt-id">
                        <label>Codigo Principal</label>
                        <input type="text" id="txt-codigou" name="codigou" readonly="" style="border-radius: 2px;"
                            placeholder="INGRESAR 14 NUMEROS" class="form-control" id="txt-codigo" maxlength="15"
                            class="form-control input-sm">

                        <br>

                    </div>
                    <div class="row">
                        <div class="col-md-3">

                        <label>Estado de Chip</label>
                        <select name="cmbchipu" id="cmb-chipu" class="form-control ">
                            <option value="0">Seleccionar</option>
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                    
                        </select>
                        </div>
                      
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn-editar" >Editar</button>
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


<?php include 'contenido/foot.php'; ?>
<script src="../js/nuevochips.js"></script>
<?php } else {
    header("location: ../");
}
?>