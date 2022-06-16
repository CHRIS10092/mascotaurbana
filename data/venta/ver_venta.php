<style type="text/css">
	.panel{
		border-radius:8px 8px 8px 8px ; 
		border: 1px solid #c6c6c6;
		border-collapse: collapse; 
		padding: 20px;
		width: 95%;
	}
</style>
<?php 
require_once'../../clases/venta.php';
$adchb_data=new venta(); 
?>
<div id="documento">
<center><label style="font-weight: bolder;font-size: 18px;">Numero de venta: #<?php 
echo $_POST['documento'];
 ?></label></center>
 <br>
 <label style="font-weight: bolder;font-size: 18px;">Datos Cliente</label><hr style="margin-top: 5px">
 <div style="border-radius:8px 8px 8px 8px ; 
		border: 1px solid #c6c6c6;
		border-collapse: collapse; 
		padding: 20px;display: inline-flex;width: 95%;">
 <?php echo $adchb_data->DatosCliente($_POST['documento']); ?>
 </div><br><br>
 <div class="panel">
 <table style="width: 95%;">
 	<tr style="font-size: 15px;">
 		<th style="text-align:left;">Descripcion</th>
 		<th style="text-align: center;">Cantidad</th>
 		<th style="text-align: center;">Precio Unit</th>
 		<th style="text-align: center;">Precio Total</th>
 	</tr>
 	 <?php echo $adchb_data->Detalleventa($_POST['documento']); ?>
 </table>
</div>
 
 <table style="width: 45%;margin-top: 20px;float: right;">
 	<tr style="font-size: 15px;">
 		<th style="text-align: center;">Subtotal</th>
 		<th style="text-align: center;">Iva</th>
 		<th style="text-align: center;">Total</th>
 	</tr>
 	 <?php echo $adchb_data->Rubros($_POST['documento']); ?>
 </table>

</div><br><br><br><br><br><br>
<center>
 <button class="btn btn-primary" onclick="imprimir_documento()">
 	<i class="fa fa-print"></i> Imprimir
 </button>
 </center>