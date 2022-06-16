<?php
session_start();
//date_default_timezone_set('America/Lima');
if (isset($_SESSION['usuario'])) {

    require_once 'contenido/head.php';

    ?>
	<form id="frmProceso" enctype="multipart/form-data">
		<ul class="nav nav-pills">
		<li id="liPaso1" class="active"><a data-toggle="pill" href="#paso1" id="btnPaso1">PASO 1</a></li>
			<li id="liPaso2" class="disabled"><a data-toggle="pill"   id="btnPaso2" >PASO 2</a></li>
		</ul>

		<div class="tab-content">
			<div id="paso1" class="tab-pane fade in active">
				<br>
				<div class="row">
					<div class="col-md-6">
										</div>
					<label class="col-md-1">Fecha:</label>
					<div class="col-md-2">
						<input type="date"  id="txtFechaVenta" class="form-control" readonly value="<?php echo date('Y-m-d') ?>">
					</div>
					<label class="col-md-1">Venta:</label>
					<div class="col-md-2">
						<input type="text"  id="txtNumeroVenta" class="form-control" readonly>
					</div>
				</div>
				<hr>
				<div class="row">
					<label class="col-md-1">Ruc/Ci:</label>
					<div class="col-md-3">
						<input type="number"  id="txtRucCliente" class="form-control">
					</div>
					<label class="col-md-1">Nombre:</label>
					<div class="col-md-3">
						<input type="text"  id="txtNombreCliente" class="form-control">
					</div>
					<label class="col-md-1">Apellido:</label>
					<div class="col-md-3">
						<input type="text"  id="txtApellidoCliente" class="form-control">
					</div>
				</div>
				<br>
				<div class="row">
					<label class="col-md-1">Direccion:</label>
					<div class="col-md-3">
						<input type="text"  id="txtDireccionCliente" class="form-control">
					</div>
					<label class="col-md-1">Correo:</label>
					<div class="col-md-3">
						<input type="text"  id="txtCorreoCliente" class="form-control">
					</div>
					<label class="col-md-1">Celular:</label>
					<div class="col-md-3">
						<input type="number"  id="txtCelularCliente" class="form-control">
					</div>
				</div>
				<br>
				<!--<button id="btnverificartabla" name="btnverificar"> verificar tabla </button>-->
				<button style="margin-left: 43%" id="btnArticulos" class="btn btn-success" data-toggle="modal" data-target="#m-articulos">
					<i class="fa fa-search"></i>
					Agregar Articulos
				</button>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Codigo</th>
									<th>Nombre</th>
									<th>Descripcion</th>
									<th>Stock</th>
									<th>Cantidad</th>
									<th>Precio</th>
									<th>Total</th>
									<th>Quitar</th>
								</tr>
							</thead>
							<tbody id="tblDatosDetalle"></tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<ul class="list-group">
							<li class="list-group-item">SUBTOTAL: <div id="subtotal-venta" style="float:right;">0.00</div></li>
							<li class="list-group-item">IVA %12: <div id="iva-venta" style="float:right;">0.00</div></li>
							<li class="list-group-item">TOTAL: <div id="total-venta" style="float:right;">0.00</div></li>
						</ul>
					</div>
					<br>
				<center><button class="btn btn-primary" id="btnRegistrarVenta">Registrar</button></center>
				</div>
			</div>

			<div id="paso2" class="tab-pane fade">
				<h3 style="text-align: center;" class="red"><strong id="numero-mascotas"></strong> Generar Vacunas</h3>
				<br>
				 <div class="row">

									  &nbsp;&nbsp;&nbsp;&nbsp;<label for="">Escriba la Cedula</label>
									<input type="text" maxlength="15" name="codigomas" id="txt-buscar">
									<button id="btn-buscar" name="buscar" class="btn btn-default">Buscar</button>


									</div>
				<div class="responsive"  id="reportems"></div>

				<br>
				<br>
				<div class="row">

					<label class="col-md-1">Fecha Desparacitacion</label>
					<div class="col-md-2">
						<input type="date"  id="txtfecha" name="fecha" class="form-control" readonly value="<?php echo date('Y-m-d') ?>">
					</div>

				</div>
				<hr>
				<div class="row">
					<!--<label class="col-md-1">Nombre Vacuna</label>-->
					<div class="col-md-3" style="visibility: hidden;">

						<select class="form-control col-md-3" id="cmblistado" name="listado">Seleccionar</select>
						<br>
					</div>
				<!--	<label class="col-md-1">Descripcion:</label>
					<div class="col-md-3">
						<textarea   id="txtdescripcion" name="descripcion" class="form-control"></textarea>
					</div>
				<label class="col-md-1">Fecha Proxima de Vacuna:</label>
					<div class="col-md-3">
						<input type="date"  id="txtfecha-fin" name="fecha-fin" class="form-control"  value="<?php echo date('Y-m-d') ?>">
					</div>
					-->
				</div>
				<br>
				<div class="row">

					<div class="col-md-3 pull-right">
						<button class="btn btn-primary" id="btnRegistrarProceso">
							Registrar
						</button>
					</div>

				</div>
				<br>

			</div>
		</div> <!-- tabla contenido-->
	</form>


	<!-- ARTICULOS MODAL -->
	<div id="m-articulos" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Listado de Articulos <i class="ace-icon fa fa-list blue"></i></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Codigo</th>
										<th>Nombre</th>
										<th>Descripcion</th>
										<th>Stock</th>
										<th>Precio</th>
										<th>Seleccionar</th>
									</tr>
								</thead>
								<tbody id="tblDatosArticulos"></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- FIN ARTICULOS MODAL -->



<!-- Modal -->
<div id="n-vacunas" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nueva Vacuna</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-12" id="alertas">
      		</div>
      	</div>
        <form id="frm-new">
      	<div class="row">

      		<div class="col-md-6">
      			<label>Descripcion</label>
      			<input type="text" name="descripcion" id="txt-descripcion" class="form-control">
      		</div>
      		<div class="col-md-6">
      			<label>Tipo de Vacunas</label>
      			<div id="listar-tipov"></div>
      		</div>
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


	<?php require_once 'contenido/foot.php';?>

	<script src="../js/desparacion.js"></script>
	<script src="../js/nueva_vacuna.js"></script>

	<?php

} else {

    header("location: ../");
}

?>