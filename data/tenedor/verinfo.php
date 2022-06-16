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
require_once '../../clases/tenedor.php';
$adchb_data = new tenedor();
?>
<div id="codigo">
		<img src="../imagenes/logocomprasegura.jpg" width="200" height="200" alt="">
<center><label style="font-weight: bolder;font-size: 18px;">Numero de Cedula: #<?php
echo $_POST['ten_cedula'];
?></label></center>
 <br>
 <label style="font-weight: bolder;font-size: 18px;">Datos Tenedor</label><hr style="margin-top: 5px">
 <div style="border-radius:8px 8px 8px 8px ;
		border: 1px solid #c6c6c6;
		border-collapse: collapse;
		padding: 20px;display: inline-flex;width: 95%;">
 <?php echo $adchb_data->DatosClientes($_POST['ten_cedula']); ?>
 </div><br><br>
 <label style="font-weight: bolder;font-size: 18px;">Datos </label><hr style="margin-top: 5px">

<div style="border-radius:8px 8px 8px 8px ;
		border: 1px solid #c6c6c6;
		border-collapse: collapse;
		padding: 20px;display: inline-flex;width: 95%;">
 <?php echo $adchb_data->DatosMascotasadmin($_POST['ten_cedula']); ?>
 </div>

</div><br><br><br><br><br><br>
<center>
 <button class="btn btn-primary" onclick="imprimir_documento()">
 	<i class="fa fa-print"></i> Imprimir
 </button>
   <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
 </center>