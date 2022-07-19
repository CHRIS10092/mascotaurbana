<?php 
session_start();
date_default_timezone_set("America/Guayaquil");
$fecha = date("Y-m-d");
require_once '../clases/procesar.php';
require_once '../helpers/funciones.php';
//print_r($_SESSION['usuario'][11]);
$obj = new Procesar;

$numero = $obj->obtener_numero_venta($_SESSION['empresa']['idempresa']);

$secuencia = secuenciales($numero, 9);

?>	

<?php if (isset($_SESSION['usuario'])): ?>
	<?php include 'contenido/head.php';?>
	<style type="text/css">
		@media print {
    .oculto-impresion,
    .oculto-impresion * {
        display: none !important;
    }

    * {
    font-size: 12px;
    font-family: 'Times New Roman';
}

td,
th,
tr,
table {
    border-top: 1px solid black;
    border-collapse: collapse;
}

td.producto,
th.producto {
    width: 75px;
    max-width: 75px;
}

td.cantidad,
th.cantidad {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

td.precio,
th.precio {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

.centrado {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 155px;
    max-width: 155px;
}

img {
    max-width: inherit;
    width: inherit;
}



}

	</style>
<form id="frmVenta">

	<center><i><span style="color:red;font-size:18px;"> Registro De Ventas</span></i></center>	
	<div class="row">
	<b><input type="hidden" name="nventa" id="nventa"  value="<?php echo $secuencia ?>" class="form-control input-sm"></b>
			<div class="col-md-3">
				<label style="font-size: 14px;"><i><b>Fecha de venta:</b><i></label>
				<b><input type="date" name="fecha" id="fecha"  value="<?php echo $fecha ?>" class="form-control input-sm"></b>
			</div>
			<div class="col-md-4">
				<label style="font-size: 14px;"><i><b>Nombre Empresa:</b><i></label>
				 <span style="" ><?php echo $_SESSION['empresa']['nombre']?></span></br></br>
				<label style="font-size: 14px;"><i><b>Celular:</b><i></label>
				<span style=""><?php echo $_SESSION['empresa']['telefono']?></span>
			</div>
			<div class="col-md-3">
			<label style="font-size: 14px;"><i><b>Correo:</b><i></label>
				 <span style=""><?php echo $_SESSION['empresa']['correo']?></span></br>
				<label style="font-size: 14px;"><i><b>Logo:</b><i></label>
				<img width="70px" heigth="40px" src="../<?php echo $_SESSION['empresa']['logo']?>">
			</div>
		</div>
		
<div class="row">
			
<div class="col-md-9">
	
	<div class="row">
			<br>
			<div class="col-md-4">
		
				<label><b>Identificación:</b></label>
				<input type="text" name="ruc" maxlength="13" placeholder="identificacion" onkeypress="return solo_numeros(event);" id="identificacion" class="form-control input-sm">
				<input type="hidden" name="idcliente" id="idcliente">
			</div>
		
			<div class="col-md-4">
				<label><b>Nombres:</b></label>
				<input type="text" placeholder="Nombres" id="cliente" name="cliente" onkeypress="return solo_letras(event);" class="form-control input-sm">
			</div>
			<div class="col-md-4">
				<label><b>Apellidos:</b></label>
				<input type="text" placeholder="Apellidos" id="apellido" name="apellido" onkeypress="return solo_letras(event);" class="form-control input-sm">
			</div>
	</div>
	<div class="row">
	<br>
			<div class="col-md-4">
				<label><b>Celular:</b></label>
				<input type="text" name="celular" placeholder="Celular" onkeypress="return solo_numeros(event);" id="celular" class="form-control input-sm">
			</div>
			<div class="col-md-4">
				<label><b>Dirección:</b></label>
				<input type="text" name="direccion" id="direccion"  placeholder="Direccion" class="form-control input-sm">
			</div>
			<div class="col-md-4">
				<label><b>Correo Electrónico:</b></label>
				<input type="text" name="correo" placeholder="Correo electronico"  id="correo" class="form-control input-sm">
			</div>
</div>
	</div>

		<div class="col-md-3">

<br>
				<div class="row">
					<div class="col-md-2"></b>
						<button class="btn btn-success btn-xl" style="margin-top:22px;padding-top: 0px;padding-right: 55px;" data-toggle="modal" data-target="#m-clientes" style="margin-top:22px">
							<i class="fa fa-search">Buscar Clientes</i>
						</button>
					</div>
				</div>
				
<br>
				<div class="row">
						<div class="col-md-1">
						<button class="btn btn-info btn-xl" style="margin-top: 14px;padding-top:0px;padding-right: 88px;" data-toggle="modal" data-target="#m-productos" style="margin-top:22px">
							<i class="fa fa-search">Productos</i>
						</button>
					</div>
				</div>
			</div>

	
		</div>
		
	
	</div>

	<br>
	
		<div class="row">
			
			<div class="col-md-3">
				
				<label><b>Detalle:</b></label>
				<input type="text" id="detalle" placeholder="Detalle" class="form-control input-sm" readonly>
				<input type="hidden" id="idproducto">
				<input type="hidden" id="codigo">
			</div>
			<div class="col-md-1">
				
				<input type="radio" name="radio" value="1"  id="chkDescuento">	Dsc $ <br>
				<input type="radio" name="radio" value="2"  id="chkDescuento1">	Dsc %
				
				
			</div>
			<div class="col-md-1">
			<label>. </label>
			<input type="text" class="form-control" id="txtDescuento"  onkeyup="calculardescuento(this)" style="text-align: right;font-size:12px;" name="descuento"  value="0.00"></th>
			</div>
			<div class="col-md-1">
				<label><b>Precio:</b></label>
				<input type="text"  id="precio" placeholder="Precio" class="form-control input-sm" readonly>
			</div>
			<div class="col-md-2">
				<label><b>Precio Pvp:</b></label>
				<input type="text"  id="preciopvp" placeholder="preciopvp" class="form-control input-sm" readonly>
			</div>
			<div class="col-md-1">
				<label><b>Descuento:</b></label>
				<input type="text"  id="descuento" value="0.00" placeholder="Descuento" class="form-control input-sm" readonly>
			</div>
			
			<div class="col-md-1">
				<label><b>Cantidad:</b></label>
				<input type="number" maxlength="1" min="1" name="" placeholder="Cantidad" id="cantidad" class="form-control input-sm" value="1" onkeypress="return soloNumeros(event)">
				<input type="hidden" id="stock">
				<input type="hidden" id="chip">
			</div>
			

			<div class="col-md-1">
				<button class="btn btn-success btn-sm" style="margin-top:22px" id="btnAgregarProducto">
					<i class="fa fa-plus"></i>
				</button>
			</div>
		</div>
		<div class="row" style="margin-top:20px">
			<div class="col-md-11">
				<table class="table table-sm" id="table-detalle">
					<thead>
						<tr>
							<th>Item</th>
							<th>Codigo</th>
							<th>Detalle</th>
							<th>Cantidad</th>
							
							<th>P.Unitario</th>
							<th>Descuento</th>
							<th>P.Total</th>
							<th style="width: 3px;">Quitar</th>
						</tr>
					</thead>
					
					<tbody id="tbldetalle"></tbody>
				</table>
				<table class="pull-right">
					
			
					<tr>
						
						<th>Subtotal</th>
						<th colsPan="2" style="text-align: right;">
						<input type="" name="subtotal" id="subtotal"  style="text-align: right;" class="form-control input-sm" placeholder="Subtotal" value="0.00" readonly>
					</th>
						
					</tr>
				
					<th>Descuento </th>
				<th><input type="text"  class="form-control" id="txtTotalDesc" style="text-align: right;font-size:12px;" name="total_descuento" readOnly value="0.00"></th>
				</tr>
				<tr>
						
						<th>Iva</th>
						<th colsPan="3"  style="padding-right: 0px;"><input type="" style="text-align: right;" name="iva" id="iva"  class="form-control input-sm" placeholder="Subtotal" value="0.00" readonly></th>
						
					</tr>
					<tr>
						<th>Total</th>
						<th colsPan=""  style="padding-right: 0px;"><input type="" name="total" id="total" style="text-align: right;" class="form-control input-sm" placeholder="Total" value="0.00" readonly></th>
						
					</tr>
					<tr>

					<th></th>
						<th colsPan=""  style="padding-right: 0px;"><button id="btnFacturar" class="form-control btn btn-primary btn-sm" style="margin-top:15px">
					Facturar
				</button></th>
						
					</tr>
				</table>
			</div>
<!--<div class="row">
			<div class="col-md-3">
				<label><b>Subtotal:</b></label>
				<input type="" name="subtotal" id="subtotal"  class="form-control input-sm" placeholder="Subtotal" value="0.00" readonly>
				<label><b>Iva:</b></label>
				<input type="" name="iva" id="iva" class="form-control input-sm" placeholder="Iva" value="0.00" readonly>
				<label><b>Total:</b></label>
				<input type="" name="total" id="total" class="form-control input-sm" placeholder="Total" value="0.00" readonly>
				<button id="btnFacturar" class="form-control btn btn-primary btn-sm" style="margin-top:15px">
					Facturar
				</button>
				
			</div>
		
	</div>
-->
</div>
	</form>

<div id="tick" style="display:none;">
	<div class="ticket" >
            <p class="centrado">TICKET DE VENTA<br>
            	<span id="t-fecha"></span> </p>
            <table>
					<thead>
						<tr>
							<th>Item</th>
							<th>Detalle</th>
							<th>Cantidad</th>
							<th>P.Unitario</th>
							<th>P.Total</th>
						</tr>
					</thead>
					<tbody id="t-detalle"></tbody>
				</table>
            <p class="centrado">¡GRACIAS POR SU COMPRA!<br>mascotaurbana</p>

        </div>
</div>

<button class="btn btn-succes btn-sm" style="display:none;" type="button" id="btnImprimir" onclick="javascript:imprim1();">Imprimir</button>

	<div id="m-productos" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><b>Productos</b></h4>
				</div>
				<div class="modal-body" id="listadoProductos">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>

	<div id="m-clientes" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><b>Clientes</b></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div id="listadoClientes"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>

	<?php include 'contenido/foot.php';?>
	<script src="../js/facturar.js"></script>
<?php else: ?>
	<?php header("location: ../");?>	
<?php endif ?>