<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>
<?php include 'contenido/head.php';?>
<div class="col-md-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-4">
    <div class="widget-box ui-sortable-handle" id="widget-box-4">
        <div class="widget-header widget-header-large">
            <h4 class="widget-title">Listado de Articulos</h4>
            <div class="widget-toolbar">
                <button class="btn btn-primary btn-xs" onclick="location.href='agregar_articulo.php'">
                    <i class="glyphicon glyphicon-plus"></i> Agregar Articulo
                </button>
                <button class="btn btn-alert btn-xs" onclick="location.href='../procesarpdf/procesar_articulosxempresa.php?buscar=<?php echo $_SESSION['empresa']['idempresa']; ?>'"'">
                    <i class="glyphicon glyphicon-print"></i> Imprimir Articulo
                </button>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div id="correcto"></div>
                <div class="table-responsive" id="listadoemp"></div>
            </div>
        </div>
    </div>
</div>

<div id="m-articulo" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editar Articulo</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" id="alertasu">
                    </div>
                </div>
                <form id="frm-edit">
                <input type="hidden" id="txtId" name="id">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Codigo</label>
                            <input type="text" id="txtCodigo" name="codigo" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Nombre</label>
                            <input type="text" id="txtNombre" name="nombre" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Descripcion</label>
                            <input type="text" id="txtDescrip" name="descrip" class="form-control">
                        </div>
                    </div><hr>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">Stock</label>
                            <input type="number" id="txtStock" name="stock" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">Valor</label>
                            <input type="number" id="txtValor" name="valor" class="form-control">
                        </div>
                        <div class="col-md-3">
                                    <label>Precio pvp</label>
                                    <input type="number" name="valorpvp" id="txtValorpvp" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Categoria</label>
                            <div id="list-categoria"></div><br>
                                <br>
                                </div>
                                <div class="col-md-4">
                            <label>Subcategoria</label>
                            <div id="list-subcategoria"></div>
                        </div>

                        <div class="col-md-4">
                        <h3>Foto Actual</h3>
                        <input type="hidden" id="txtFoto" name="foto">
                        <img width="180px" height="150px" id="imgArticulo">
                        </div>
                        <div class="col-md-4">
                        <h3>Cargar Nueva Foto</h3>
                        <input type="file" id="txtFotoActual" name="foto-actual">
                        <div id="preview"></div>
                        </div>
                        <input type="hidden" name="session" value="<?php echo $_SESSION['empresa']['idempresa'] ?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnEditar" class="btn btn-primary" id="btn-editar">Editar</button>
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
<script src="../js/inventario.js"></script>
<?php } else {
    header("location: ../");
}
?>