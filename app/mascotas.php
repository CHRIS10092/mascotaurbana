<?php session_start();
require_once "../app/contenido/head.php";
?>
<center>
    <h2 class="green">
        <i class="ace-icon fa fa-paw bigger-110"></i>

        <span> FORMULARIO NUEVA MASCOTA </span>
    </h2>
</center>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <!-- /.box-header -->
            <div class="box-body">


            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

<div id="correcto"></div>
<div id="alertas"></div>


<form id="frm-mascotas" enctype="multipart/form-data">
    <div class="box box-primary">

        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <center>
                                <h3 class="box-title">Datos Tenedor</h3>
                            </center>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="btn btn-primary pull-right" data-toggle="modal"
                                        data-target="#m-tenedor">
                                        Buscar <i class="glyphicon glyphicon-search"></i>
                                    </span>
                                </div>
                            </div><br>

                            <div class="row">
                                <div class="col-md-12">

                                    <input type="hidden" name="tenedor" id="txt-tenedor">
                                    <label>Num. Identificación</label>
                                    <input type="text" id="txt-numero" readonly class="form-control input-sm">
                                    <label>Nombre</label>
                                    <input type="text" readonly id="txt-nombre-usu" class="form-control input-sm">
                                    <label>Apellido</label>
                                    <input type="text" readonly id="txt-apellido-usu" class="form-control input-sm">
                                    <hr>
                                    <br>
                                    <div id="datos-registros"></div>
                                </div>
                            </div>
</form>
</div>
<!-- /.box-body -->
</div>
</div>
<div class="col-md-8">
    <div class="box box-info">
        <div class="box-header with-border">
            <center>
                <h3 class="box-title">Información Mascota</h3>
            </center>
        </div>
        <div class="box-body">

            <div class="col-md-4">

                <label>Codigo Principal</label>
                <input type="text" name="codigo" onkeypress="return validar_numeros(event);" style="border-radius: 2px;"
                    placeholder="INGRESAR 15 NUMEROS" class="form-control" id="txt-codigo" maxlength="15"
                    class="form-control input-sm">

                <label>Nombre</label>
                <input type="text" name="nombre" onkeypress="return validar_letras(event);" id="txt-nombre"
                    class="form-control">
                <label for="txt-sexo">Sexo</label>
                <br>
                <select name="cmbsexo" id="cmb-sexo" class="form-control ">
                    <option value="0">Seleccionar</option>
                    <option value="Macho">Macho</option>
                    <option value="Hembra">Hembra</option>
                </select>

                <label>Fecha de Nac</label>
                <input type="date" name="fecha" id="txt-fecha" class="form-control "><br>

            </div>
            <div class="row">
                <div class="col-md-3">


                    <label>Color</label>
                    <input type="text" name="color" onkeypress="return validar_letras(event);" id="txt-color"
                        class="form-control ">


                    <label>Tipo Mascota</label>
                    <div id="especies"></div>

                    <label>Tipo Razas</label>
                    <div id="razas"></div>
                    <br>
                    <button class="btn btn-primary btn-group-lg form-control" id="btn-registrar">Guardar
                        <i class="glyphicon glyphicon-floppy-disk"></i></button>
                </div>
                <div class="col-md-4">
                    <label>Color 1</label>
                    <input type="text" name="color1" onkeypress="return validar_letras(event);" id="txt-color1"
                        class="form-control ">
                    <label>Esterilizado</label>
                    <select name="cmb-esterilizado" id="cmb-esterilizado" class="form-control">
                        <option value="0">Seleccionar</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                    <input type="hidden" name="session" readonly id="txt-session" class="form-control input-sm"
                        value="<?php echo $_SESSION['empresa']['idempresa'] ?>">
                    <input type="hidden" name="sucursal" readonly id="txt-sucursal" class="form-control input-sm"
                        value="<?php echo $_SESSION['sucursal']['codigo'] ?>">
                    <!--  <label>Edad</label>-->
                    <input type="hidden" name="edad" readonly id="txt-edad" class="form-control input-sm">
                    <label>Foto</label>
                    <input type="file" name="img" id="txt-img" class="form-control ">
                    <div style="width: 50px  " id="preview"> </div>
                    <br>

                </div>
            </div>


        </div>


        <!-- /.box-body -->
    </div>
</div>
</div>
</div>
<!-- /.box-body -->
</div>
</form>


<!-- Modal buscar tenedor -->
<div class="modal fade" id="m-tenedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Listado de Tenedores</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="listado-clientes"></div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- Modal buscar mascotas -->
<div class="modal fade" id="m-mascotas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Listado de Mascotas</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="listado-mascotas"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
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
                <h4 class="modal-title" id="exampleModalLabel">Editar Mascota</h4>
            </div>
            <div class="modal-body">
                <form id="frm-mascotau">
                    <div class="row">
                        <div class="col-md-4">
                            <div id="listado-clientesu"></div><br>
                            <div id="listado-tiposu"></div>
                        </div>
                        <div class="col-md-4">
                            <input type="hidden" name="id" id="txt-id">
                            <label for="txt-nombreu">Nombre</label>
                            <input type="text" name="nombreu" id="txt-nombreu" class="form-control input-sm">
                            <label for="txt-coloru">Color</label>
                            <input type="text" name="coloru" id="txt-coloru" class="form-control input-sm">
                            <label for="txt-fechau">Fecha de Nac</label>
                            <input type="date" name="fechau" id="txt-fechau" class="form-control input-sm"><br>
                            <div id="listado-sexou"></div>
                        </div>
                        <div class="col-md-4">
                            <label for="txt-razau">Raza</label>
                            <input type="text" name="razau" id="txt-razau" class="form-control input-sm">
                            <label for="txt-pesou">Peso KG.</label>
                            <input type="number" name="pesou" id="txt-pesou" class="form-control input-sm">
                            <label for="txt-edad">Edad</label>
                            <input type="text" name="edadu" readonly id="txt-edadu" class="form-control input-sm"><br>
                            <span class="btn btn-success form-control" id="btn-editar">Guardar</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- detallar-->


<?php require_once "../app/contenido/foot.php"; ?>
<script type="text/javascript" src="../js/mascotas.js"></script>