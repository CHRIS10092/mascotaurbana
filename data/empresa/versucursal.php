<style type="text/css">
.panel {
    border-radius: 8px 8px 8px 8px;
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
    <center><label style="font-weight: bolder;font-size: 18px;">Nombre de empresa:
            <?php
			echo $_POST['emp_id'];
			?></label></center>


    <label style="font-weight: bolder;font-size: 18px;">Datos Sucursal Principal</label>

    <div style="border-radius:8px 8px 8px 8px ;
		border: 1px solid #c6c6c6;
		border-collapse: collapse;
		padding: 20px;display: inline-flex;width: 95%;">
        <?php echo $adchb_data->DatosSucursal($_POST['emp_id']); ?>
    </div><br>
    <label style="font-weight: bolder;font-size: 18px;">Datos Sucursal Secudarias </label>
    <div style="border-radius:8px 8px 8px 8px ;
		border: 1px solid #c6c6c6;
		border-collapse: collapse;
		padding: 20px;display: inline-flex;width: 95%;">
        <?php echo $adchb_data->DatosSucursalSecundaria($_POST['emp_id'])	?>
    </div><br><br>
    <center>
        <button class="btn btn-primary" onclick="imprimir_documentosuc()">
            <i class="fa fa-print"></i> Imprimir
        </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </center>