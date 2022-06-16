<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>
	<?php include 'contenido/head.php';?>
	<h2 class="blue">
		<i class="ace-icon fa fa-plus bigger-110"></i>
		Buscar facturas electronicas
	</h2>

	<form id="frm-facturas">
		<div class="row">
			<div class="col-md-3">
				<label>Numero de factura:</label>
				<input type="text" name="numero" id="numero" placeholder="Numero de factura" class="form-control input-sm">
			</div>
			<div class="col-md-3">
				<label>Identificacion de cliente:</label>
				<input type="text" name="identificacion" id="identificacion" placeholder="Identificacion de cliente" class="form-control input-sm">
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<label>Fecha inicio:</label>
				<input type="date" class="form-control input-sm" name="inicio" id="inicio">
			</div>
			<div class="col-md-3">
				<label>Fecha fin:</label>
				<input type="date" class="form-control input-sm" name="fin" id="fin">
			</div>
		</div>
		<br/>
		<button class="btn btn-primary btn-sm">Buscar</button>
	</form>
	<table class="table table-sm">
		<thead>
			<tr>
				<th>Numero factura</th>
				<th>Cliente</th>
				<th>Fecha de emision</th>
				<th>Valor total</th>
				<th>Estado</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody id="tbl-fact-datos"></tbody>
	</table>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Envio Sri</h4>
      </div>
      <div class="modal-body">
        <p>Respuestas SRI</p>
        <p id="errores" style="display: none"></p>
        <table class="table table-sm" id="tbl-sri" style="display: none">
        	<thead>
        		<tr>
        			<th>
        				respuesta
        			</th>
        			<th>
        				identificador
        			</th>
        			<th>
        				mensaje
        			</th>
        			<th>
        				informacion adicional
        			</th>
        			<th>
        				tipo
        			</th>
        		</tr>
        	</thead>
        	<tbody id="tbl-recepcion">

        	</tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<div id="imagen" style="display: none;">
<img src="../imagenes/cargando.gif" alt="">
 </div>
	<?php include 'contenido/foot.php';?>
	<script src="../js/envio.js"></script>
<?php } else {
    header("location: ../");
}
?>