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
<center><label style="font-weight: bolder;font-size: 18px;">Ruc de Empresa: #<?php
echo $_POST['emp_ruc'];
?></label></center>
 <br>
 <label style="font-weight: bolder;font-size: 18px;">Datos Cliente</label><hr style="margin-top: 5px">
 <div style="border-radius:8px 8px 8px 8px ;
		border: 1px solid #c6c6c6;
		border-collapse: collapse;
		padding: 20px;display: inline-flex;width: 95%;">
 <?php echo $adchb_data->DatosClientes($_POST['emp_ruc']); ?>
 </div><br><br>
 <label style="font-weight: bolder;font-size: 18px;">Datos </label><hr style="margin-top: 5px">



</div><br><br><br><br><br><br>
<center>
 <button class="btn btn-primary" onclick="imprimir_documento()">
 	<i class="fa fa-print"></i> Imprimir
 </button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
 </center>