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

require_once '../clases/NotasCredito.php';
    $obj = new NotasCredito;
    $data = $obj->GetById($_GET['id']);
    //print_r($data);
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

	<i><span style="color:red;font-size:18px;padding-right: 8px;padding-left: 666px;"> Nota de Crédito</span></i>
	<div class="row">
    <div class="col-md-6">
    
    <img style="width: 415px;height: 144px;padding-left: 89px;margin-top: -38px;" src="../imagenes/vert.png" src="../<?php echo $_SESSION['empresa']['logo']?>">
                <p style="padding-left: 110px;"> Dirección de Matriz</p>
                <p style="padding-left: 110px;"> Dirección de Sucursal</p>
    </div>
    <div class="col-md-4">
        <div style="border:0px">
        <table border="1" class="table table responsive">
            <tr>
                <td>RUC</td>
                <td>1720348232</td>
            </tr>
            <tr>
            <center><td  colsPan="2">NOTA DE CREDITO <BR>
            NO 004-002-128923877823
            </td></center>
            </tr>
            <tr>
            <td>AUTORIZACION</td>
            <td>1234456778</td>
            </tr>
        </table>

        </div>
    </div>

		</div>
		
<div class="row">
			
<div class="col-md-9">
	
	<div class="row">
			<br>
			<div class="col-md-6">
		
				<label><b>Identificación:</b></label>
				<input type="text" readonly name="ruc" placeholder="identificacion" onkeypress="return solo_numeros(event);" id="identificacion" value="<?php echo $data->ruc?>" class="form-control input-sm">
				<input type="hidden" name="idcliente" id="idcliente">
			</div>
			<div class="col-md-6">
				<label><b>Fecha de Emision:</b></label>
				<input type="text" readonly name="fecha" id="fecha"  value="<?php echo $data->fecha?>" placeholder="Fecha" class="form-control input-sm">
			</div>
			
	</div>
	<div class="row">
	<br>
			
		
            <div class="col-md-6">
				<label><b>Nombres:</b></label>
				<input type="text" readonly placeholder="Nombres Completos"  value="<?php echo $data->nombre.'-'.$data->apellido?>" id="cliente" name="cliente" onkeypress="return solo_letras(event);" class="form-control input-sm">
			</div>
			<div class="col-md-6">
				<label><b>Comprobante que Modifica:</b></label>
				<input type="text" readonly name="comprobante" placeholder="Comprobante que modifica"  value="<?php echo $data->comprobante?>" onkeypress="return solo_numeros(event);" id="comprobante" class="form-control input-sm">

			</div>
			<div class="col-md-6">
				<label><b>Motivo que Modifica:</b></label>
				<input type="text" name="motivo" placeholder="Comprobante que modifica" onkeypress="return solo_letras(event);" id="comprobante" class="form-control input-sm">

			</div>
			<br>
</div>
	</div>
	<br>
<?php
	require_once '../clases/NotasCredito.php';
$adchb_data = new NotasCredito();
$datos=$adchb_data->detalles($_GET['id'],$_SESSION['empresa']['idempresa'],$_SESSION['sucursal']['codigo']);
$datos1=$adchb_data->detalles1($_GET['id'],$_SESSION['empresa']['idempresa'],$_SESSION['sucursal']['codigo']);
?>	
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
							
						</tr>
					</thead>
					<?php foreach($datos as $obj) : ?>

					<tr>
							<th><?php echo $obj['ven_id']?></th>
							<th><?php echo $obj['ven_numero']?></th>
							<th><?php echo $obj['inv_nombre']?></th>
							<th><?php echo $obj['detven_cantidad']?></th>
							<th><?php echo $obj['detven_precio']?></th>
							<th><?php echo $obj['descuento']?></th>
							<th><?php echo $obj['detven_total']?></th>
					</tr>
					<?php endforeach  ?>

				</table>
				<table class="pull-right">
					
				<?php foreach($datos1 as $obj1) : ?>
					<tr>
						
						<th>Subtotal</th>
						<th colsPan="2" style="padding-right: 0px;"><input type="" name="subtotal" id="subtotal"  class="form-control input-sm" placeholder="Subtotal" value="<?php echo $obj1['ven_subtotal']?>" readonly></th>
						
					</tr>
					<tr>
					<th>Descuento</th>
					<th><input type="text" class="form-control" id="txtDescuento" name="descuento" readOnly value="<?php echo $obj1['descuento']?>"></th>
				</tr>
				<tr>
						
						<th>Iva</th>
						<th colsPan="3"  style="padding-right: 0px;"><input type="" name="iva" id="iva"  class="form-control input-sm" placeholder="Subtotal" value="<?php echo $obj1['ven_iva']?>" readonly></th>
						
					</tr>
					<tr>
						<th>Total</th>
						<th colsPan=""  style="padding-right: 0px;"><input type="" name="total" id="total" class="form-control input-sm" placeholder="Total" value="<?php echo $obj1['ven_total']?>" readonly></th>
						
					</tr>
					<tr>

					<th></th>
					<th colsPan=""  style="padding-right: 0px;"><button id="btnFacturar" class="form-control btn btn-primary btn-sm" style="margin-top:15px">
					<img src="../imagenes/icons8-returns-64.png" width="20px" height="20px">Registrar Devolución<i>
				</button></th>
						
					</tr>
				</table>
				<?php  endforeach ?>
			</div>

</div>
	</form>
	</div>
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

	<?php include 'contenido/foot.php';?>
	<script src="../js/notascredito.js"></script>
<?php else: ?>
	<?php header("location: ../");?>	
<?php endif ?>