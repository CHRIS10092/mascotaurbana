<?php
//session_set_cookie_params(60*60*24*1)//para un dia
session_start();
//date_default_timezone_set('America/Lima');
if (isset($_SESSION['usuario'])) {
?>
<?php include 'contenido/head.php'; ?>
<h2 class="blue">
    <i class="ace-icon fa fa-plus bigger-110"></i>
    Agregar Nuevo Articulo
</h2>

<div class="row">
    <div class="col-md-4">
        <div class="widget-box ui-sortable-handle">
            <div class="widget-header widget-header" style="background:#478FCA!important">
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <center><img src="../imagenes/logocomprasegura.jpg" class="img-thumbnail"></center>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-6">
        <div class="widget-box ui-sortable-handle">
            <div class="widget-header widget-header" style="background:#478FCA!important;color: white;">
                <h4>Detalle del Articulo</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="row">
                        <div class="col-md-12" id="alertas">
                        </div>
                        <div id="correcto"></div>
                    </div>
                    <form enctype="multipart/form-data" id="frm-new">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Codigo</label>
                                <input type="text" name="codigo" maxlength="15" id="txt-codigo" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>Nombre</label>
                                <input type="text" name="nombre" id="txt-nombre" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-11">
                                <label>Descripcion</label>
                                <textarea class="form-control" name="descripcion" id="txt-des"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <br>

                            <div class="col-md-4">
                                <label>Stock</label>
                                <input type="text" name="stock" id="txt-stock" class="form-control" maxlength="4"
                                    onkeypress="return solo_numeros(event)">
                            </div>

                            <!--	<label >Categoria</label>
							<div id="listadotipo" >-->
                            <div class="col-md-4">
                                <label>Categoria</label>
                                <div id="list-categoria"></div><br>
                                <br>
                            </div>
                            <div class="col-md-4">
                                <label>Subcategoria</label>
                                <div id="list-subcategoria"></div>
                            </div>

                        </div>




                        <div class="row">
                            <div class="col-md-3">
                                <label>Precio compra</label>
                                <input type="number" min="0" name="valor" id="txt-valor" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>Precio pvp</label>
                                <input type="number" min="0" required name="valorpvp" id="txt-valorpvp"
                                    class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Fecha Expiración</label>
                                <input type="date" name="expiracion" id="txt-expiracion" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Numero Lote</label>
                                <input type="text" name="lote" id="txt-lote" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>imagen</label>
                                <input type="file" name="img" id="txt-img" class="form-control">
                            </div>
                            <div style="width: 200px  " id="preview"> </div>
                            <br>
                            <input type="hidden" name="session" value="<?php echo $_SESSION['empresa']['idempresa'] ?>">
                            <input type="hidden" name="sucursal"
                                value="<?php echo $_SESSION['sucursal']['codigo_suc']	?>">
                        </div>
                        <br><br><br>
                        <button class="btn btn-primary" id="btn-guardar">Guardar Datos</button>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'contenido/foot.php'; ?>
<script src="../js/articulo.js"></script>
<?php } else {
	header("location: ../");
}
?>