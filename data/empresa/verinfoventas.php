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
require_once '../../clases/empresas.php';
$adchb_data = new empresa();
?>
<div id="codigo">
		<img src="../imagenes/logocomprasegura.jpg" width="200" height="200" alt="">
<center><label style="font-weight: bolder;font-size: 18px;">Numero de Venta: #<?php
echo $_POST['emp_id'];
?></label></center>
 <br>
 <label style="font-weight: bolder;font-size: 18px;">Datos Detalles</label><hr style="margin-top: 5px">
 <div style="border-radius:8px 8px 8px 8px ;
		border: 1px solid #c6c6c6;
		border-collapse: collapse;
		padding: 20px;display: inline-flex;width: 95%;">
 <?php echo $adchb_data->DatosCabecera($_POST['emp_id']); ?>
 </div><br><br>


<br><br>
 <div class="panel">
 <table style="width: 95%;">
 	<tr style="font-size: 15px;">

 	</tr>
 	 <?php echo $adchb_data->DetalleVenta($_POST['emp_id']); ?>
 </table>
</div>
</div>
<center>
 <button class="btn btn-primary" onclick="imprimir_documento()">
 	<i class="fa fa-print"></i> Imprimir
 </button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
 </center>