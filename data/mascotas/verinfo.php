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
require_once '../../clases/mascotas.php';
$adchb_data = new mascotas();
?>
<div id="codigo">
	<center><img src="../imagenes/logocomprasegura.jpg" width="200" height="200" alt=""></center>
 <br>
 <left><h1><label style="font-weight: bolder;font-size: 18px;">Reporte Datos de Mascota</label><hr style="margin-top: 5px"></h1></left>

</label></center>
 <div style="border-radius:8px 8px 8px 8px ;
		border: 1px solid #c6c6c6;
		border-collapse: collapse;
		padding: 20px;display: inline-flex;width: 95%;">
 <?php echo $adchb_data->DatosClientes($_POST['codigo']); ?>
 </div><br><br>
 <label style="font-weight: bolder;font-size: 18px;">Informacion Tenedor</label><hr style="margin-top: 5px">
 <div style="border-radius:8px 8px 8px 8px ;
		border: 1px solid #c6c6c6;
		border-collapse: collapse;
		padding: 20px;display: inline-flex;width: 95%;">
 <?php echo $adchb_data->DatosTenedor($_POST['codigo']); ?>
 </div><br><br>



</div><br><br><br><br><br><br>
<center>
 <button class="btn btn-primary" onclick="imprimir_documento()">
 	<i class="fa fa-print"></i> Imprimir
 </button>
   <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
 </center>