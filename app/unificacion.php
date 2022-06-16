<?php
session_start();
date_default_timezone_set("America/Guayaquil");
$fecha = date("d-m-Y");

if (isset($_SESSION['usuario'])) {
?>
<?php include 'contenido/head.php'; ?>

<div class="row">
    <div class="col-sm-6">
        <table>
            <tr>
                <td><label class="control-label">Fecha:</label></td>
                <td><label class="control-label">ºVenta:</label></td>
                <td><label class="control-label">RUC/Cedula:</label></td>
            </tr>
            <tr>
                <td><input class="form-control " type="text" value="<?php echo $fecha ?>"></td>
                <td><input class="form-control form-control-sm" type="text"></td>
                <td><input class="form-control form-control-sm" type="text" onchange="VerificarCliente(this)"></td>
            </tr>

        </table>

    </div>

    <div class="col-sm-6">
        <?php print_r($_SESSION['empresa']['idempresa']); ?>
        <?php print_r($_SESSION['sucursal']['codigo']); ?>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <table>

            <tr>
                <td><label>Razon Social:</label></td>
                <td><br><label>Direccion:</label></td>
                <td><br><label>Correo</label></td>
                <td><label>Telefono:</label></td>
            </tr>
            <tr>
                <td><input type="text" id="razon"></td>
                <td><input type="text" id="direccion"></td>
                <td><input type="text" id="correo"></td>
                <td><input type="text" id="telefono"></td>
            </tr>
        </table>
    </div>
</div>



<div>
    <br><button class="btn btn-success pull-right" data-toggle="modal" data-target="#m-productos">Productos</button>

    <div>


        <br>
        <div class="row">
            <table id="detalle_product" class="table table-responsive">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Cantidad</th>
                        <th>Descripcion</th>
                        <th>P.Unit</th>
                        <th>P.Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="DataProducts"></tbody>
            </table>


            <table>
                <div class="col-md-7">
                    <tr>

                        <td colspan="4" style="text-align:center">Subtotal:</td>
                        <td id="subtotal"></td>
                    </tr>
                    <tr>

                        <td colspan="4">IVA:</td>
                        <td id="iva"></td>
                    </tr>
                    <tr>

                        <td colspan="4">Total:</td>
                        <td id="total"></td>
                    </tr>
                    <tr>

                        <td><button class="btn btn-success pull-right " onclick="guardar()">Guardar</button></td>
                    </tr>
                </div>
            </table>
        </div>
        <!-- Modal ver productos -->

        <div id="m-productos" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="col-md-12">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Lista de productos</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="TblProducts">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descripcion</th>
                                                <th>Stock</th>
                                                <th>Precio venta</th>
                                                <th>Imagen</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ListProducts"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </div>
        </div>

        <!--<div>
		<h2>HISTORIAL CLINICO DE VACUNAS,DESPARACTIANTES, Y SEGUROS EXEQUIALES</h2>
		<table class="table table-hover">

			<thead>
				<th>
					<button onclick="CrearHistorial()">+</button>
				</th>
				<th>TIPO</th>
				<th >CODIGO</th>
				<th >DESCRIPCION</th>
				<th >ANTECEDENTES</th>
				<th >FECHA HOY</th>
				<th >PROXIMO FECHA</th>
			</thead>
			<tbody id="tbl-historial"></tbody>


		</table>
	</div>
-->
        <?php include 'contenido/foot.php'; ?>
        <script src="../js/unificacion.js"></script>
        <?php } else {
        header("location: ../");
    }
        ?>