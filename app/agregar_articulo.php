<?php
//session_set_cookie_params(60*60*24*1)//para un dia
session_start();
date_default_timezone_set('America/Lima');
$fecha=date('YY-MM-DD');
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
                
        <div>
        <label class="col-sm-1 control-label no-padding-right" for="txtCosto">Costo: 
        <input type="radio" value=1 name="costos" checked onchange="ver_activacion(this.value)"></label>

<div class="col-sm-3">


<input type="number" class="form-control" id="txtCosto" name="costo" step="any">


</div>
        </div>


<label class="col-sm-2 control-label no-padding-right" for="txtCosto">Costo Iva: <input


type="radio" value=2 name="costos" onchange="ver_activacion(this.value)"></label>





<div class="col-sm-3">


<input type="number" class="form-control" id="txtCostoIva" name="costo-iva" readOnly


step="any" onkeyup="calcular_costo(this.value)">


</div>


                        <div class="row">
                          
                                                       
                            <div class="col-md-3">      
                                <input type="date" value="<?php echo $fecha ?>" name="expiracion" id="txt-expiracion" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Número Lote</label>
                                <input type="text" name="lote" id="txt-lote" class="form-control">
                            </div>
                            <!--<div class="col-md-3">
                          <label>Costo Compra:</label>
                        <input type="text" name="costocompra" id="txtCostoCompra" class="form-control">
                          </div>-->  
                            <div class="col-md-4">
                                <label>imagen</label>
                                <input type="file" name="img" id="txt-img" class="form-control">
                            </div>
                            <div style="width: 200px  " id="preview"> </div>
                            <br>
                            <input type="hidden" name="session" value="<?php echo $_SESSION['empresa']['idempresa'] ?>">
                            <input type="hidden" name="sucursal"
                                value="<?php echo $_SESSION['sucursal']['codigo_suc']	?>">
                        </div>
                        <br><br>
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